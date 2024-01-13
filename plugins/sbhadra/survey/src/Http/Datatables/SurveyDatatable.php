<?php

namespace Sbhadra\Survey\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Survey\Models\Survey;

class SurveyDatatable extends PostTypeDataTable
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
            
            // 'title' => [
            //     'label' => trans('sbph::app.name'),
            //     'formatter' => [$this, 'rowActionsFormatter']
            // ],
            'customer_name' => [
                'label' => trans('sbph::app.customer_name'),
                'formatter' => function ($value, $row, $index) {
                    return $row->customer_name;
                }
            ],
            'customer_mobile' => [
                'label' => trans('sbph::app.mobile_number'),
                'formatter' => function ($value, $row, $index) {
                    return '<a href="https://wa.me/+965'. $row->customer_mobile.'" >'.$row->customer_mobile.'</a>';
                }
            ],
            'survey_coupon' => [
                'label' => 'Coupon',
                'formatter' => function ($value, $row, $index) {
                    return $row->survey_coupon;
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
            'actions' => [
                'label' => trans('sbph::app.actions'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    $view_details = route('admin.survey.view', [$row->id]);
                    return '<a href="'.$view_details.'" class="btn btn-sm btn-primary"> <i class=" fa fa-eye"></i> View</a>';
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
        $query = Survey::query();
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
                Survey::destroy($ids);
                break;
        }
    }
}
