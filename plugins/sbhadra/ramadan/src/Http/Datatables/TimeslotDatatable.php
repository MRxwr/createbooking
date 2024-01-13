<?php

namespace Sbhadra\Ramadan\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Photography\Models\Timeslot;

class TimeslotDatatable extends PostTypeDataTable
{
 

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
            'title' => [
                'label' => trans('sbph::app.name'),
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'starttime' => [
                'label' => trans('sbph::app.starttime'),
                'formatter' => function ($value, $row, $index) {
                    return $row->starttime;
                }
            ],
            'endtime' => [
                'label' => trans('sbph::app.endtime'),
                'formatter' => function ($value, $row, $index) {
                    return $row->endtime;
                }
            ],
            'slot_type' => [
                'label' => trans('sbph::app.slot_type'),
                'formatter' => function ($value, $row, $index) {
                    return $row->slot_type;
                }
            ],
            'Status' => [
                'label' => trans('sbph::app.status'),
                'formatter' => function ($value, $row, $index) {
                    return $row->status;
                }
            ],
            'created_at' => [
                'label' => trans('sbph::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ],
            // 'actions' => [
            //     'label' => trans('sbph::app.actions'),
            //     'width' => '15%',
            //     'sortable' => false
            // ]
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
        $query = Timeslot::query();
        $query->where('slot_type','ramadan');
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
                $q->where('starttime', 'like', '%'. $keyword .'%');
                $q->orWhere('endtime', 'like', '%'. $keyword .'%');
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                Timeslot::destroy($ids);
                break;
        }
    }
}
