<?php

namespace Sbhadra\Slider\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Slider\Models\Slider;

class SliderDatatable extends PostTypeDataTable
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
                'label' => trans('sbsl::app.name'),
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'created_at' => [
                'label' => trans('sbsl::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ],
            'actions' => [
                'label' => trans('sbsl::app.actions'),
                'width' => '15%',
                'sortable' => false
                
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
        $query = Slider::query();
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
                Slider::destroy($ids);
                break;
        }
    }
}
