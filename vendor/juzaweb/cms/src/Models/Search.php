<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Juzaweb\Facades\HookAction;

/**
 * Juzaweb\Models\Search
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $keyword
 * @property string $slug
 * @property string|null $thumbnail
 * @property int $post_id
 * @property string $post_type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Search newModelQuery()
 * @method static Builder|Search newQuery()
 * @method static Builder|Search query()
 * @method static Builder|Search whereCreatedAt($value)
 * @method static Builder|Search whereDescription($value)
 * @method static Builder|Search whereId($value)
 * @method static Builder|Search whereKeyword($value)
 * @method static Builder|Search wherePostId($value)
 * @method static Builder|Search wherePostType($value)
 * @method static Builder|Search wherePublish()
 * @method static Builder|Search whereSearch($params)
 * @method static Builder|Search whereSlug($value)
 * @method static Builder|Search whereStatus($value)
 * @method static Builder|Search whereThumbnail($value)
 * @method static Builder|Search whereTitle($value)
 * @method static Builder|Search whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Juzaweb\Models\Taxonomy[] $taxonomies
 * @property-read int|null $taxonomies_count
 */
class Search extends Model
{
    protected $table = 'search';
    protected $fillable = [
        'title',
        'description',
        'keyword',
        'slug',
        'post_id',
        'post_type',
        'status',
    ];

    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class, 'term_taxonomies', 'term_id', 'taxonomy_id', 'post_id')
            ->withPivot(['term_type']);
    }

    public function post()
    {
        $model = $this->getPostType('model');

        return $this->belongsTo($model, 'post_id', 'id');
    }

    public function getPostType($key = null)
    {
        $postType = HookAction::getPostTypes($this->post_type);

        if (empty($key)) {
            return $postType;
        }

        return $postType->get($key);
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeWherePublish($builder)
    {
        $builder->where('status', '=', 'publish');

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param array $params
     *
     * @return Builder
     */
    public function scopeWhereSearch($builder, $params)
    {
        if ($keyword = Arr::get($params, 'q')) {
            $keyword = trim($keyword);
            if (DB::getDefaultConnection() == 'mysql') {
                //$builder->selectRaw(DB::raw('MATCH (`title`) AGAINST (?) AS match_score', [$keyword]));
                $builder->where(function (Builder $q) use ($keyword) {
                    $q->whereRaw('MATCH (`title`) AGAINST (? IN BOOLEAN MODE)', [$keyword]);
                    $q->orWhereRaw('MATCH (`description`) AGAINST (? IN BOOLEAN MODE)', [$keyword]);
                    $q->orWhereRaw('MATCH (`keyword`) AGAINST (? IN BOOLEAN MODE)', [$keyword]);
                    $q->orWhere('title', 'like', '%'.$keyword.'%');
                    $q->orWhere('description', 'like', '%'.$keyword.'%');
                    $q->orWhere('keyword', 'like', '%'.$keyword.'%');
                });
            } else {
                // $builder->addSelect(DB::raw('NULL AS match_score'));
                $builder->where(function (Builder $q) use ($keyword) {
                    $q->where('title', 'like', '%'.$keyword.'%');
                    $q->orWhere('description', 'like', '%'.$keyword.'%');
                    $q->orWhere('keyword', 'like', '%'.$keyword.'%');
                });
            }
        }

        if ($type = Arr::get($params, 'type')) {
            $builder->where('post_type', '=', $type);
            $postTypes = collect([$type => HookAction::getPostTypes($type)]);
        }

        if (empty($postTypes)) {
            $postTypes = HookAction::getPostTypes();
        }

        $builder->where(function (Builder $q) use ($postTypes, $params) {
            foreach ($postTypes as $typeKey => $postType) {
                $taxonomies = HookAction::getTaxonomies($typeKey);

                foreach ($taxonomies as $key => $taxonomy) {
                    $ids = array_filter(Arr::get($params, $key, []), function ($item) {
                        return ! empty($item);
                    });

                    if ($ids) {
                        $q->whereHas('taxonomies', function (Builder $q) use ($key, $params, $ids) {
                            $q->whereIn("{$q->getModel()->getTable()}.id", $ids);
                        });
                    }
                }
            }
        });

        if ($sort = Arr::get($params, 'sort')) {
            switch ($sort) {
                case 'latest':
                    $builder->orderBy('id', 'DESC');

                    break;
                /*case 'top_views':
                    $builder->orderBy('views', 'DESC');
                    break;*/
                case 'new_update':
                    $builder->orderBy('updated_at', 'DESC');

                    break;
            }
        }

        $builder = apply_filters('frontend.search_query', $builder, $params);

        return $builder;
    }
}
