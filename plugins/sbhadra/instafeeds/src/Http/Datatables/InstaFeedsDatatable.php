<?php

namespace Sbhadra\Instafeeds\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Instafeeds\Models\FeedGallery;

class InstaFeedsDatatable extends PostTypeDataTable
{
    protected $tvSeries;

    public function mount($postType)
    {
        parent::mount($postType);
    }

    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns()
    {
        return [
            'thumbnail' => [
                'label' => trans('sbph::app.thumbnail'),
                'width' => '7%',
                'formatter' => function ($value, $row, $index) {
                    return '<img src="'. $row->getThumbnail() .'" class="w-100" />';
                }
            ],
            'title' => [
                'label' => trans('sbph::app.name'),
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'url' => [
                'label' => trans('sbin::app.link'),
                'formatter' => function ($value, $row, $index) {
                    return $row->url;
                }
            ],
            'created_at' => [
                'label' => trans('sbph::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ]
        ];
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data)
    {
        $query = FeedGallery::query();
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                Gallery::destroy($ids);
                break;
        }
    }
}
