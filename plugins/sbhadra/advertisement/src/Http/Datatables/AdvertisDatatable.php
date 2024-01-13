<?php

namespace Sbhadra\Advertisement\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Advertisement\Models\Advertise;

class AdvertisDatatable extends PostTypeDataTable
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
                'label' => trans('sbsl::app.thumbnail'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    return '<img src="'. $row->getThumbnail() .'" class="w-100" />';
                }
            ],
            'title' => [
                'label' => trans('sbad::app.title'),
                'width' => '30%',
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'url' => [
                'label' => trans('sbad::app.url'),
                'formatter' => function ($value, $row, $index) {
                    return $row->url;
                }
            ],
            'created_at' => [
                'label' => trans('sbsl::app.created_at'),
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
        $query = Advertise::query();
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
                $q->orWhere('description', 'like', '%'. $keyword .'%');
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                Advertise::destroy($ids);
                break;
        }
    }
}
