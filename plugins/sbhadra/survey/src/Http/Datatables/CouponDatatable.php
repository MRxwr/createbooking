<?php

namespace Sbhadra\Survey\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Coupons\Models\Coupon;

class CouponDatatable extends PostTypeDataTable
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
            'title' => [
                'label' => trans('sbco::app.name'),
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'coupon_code' => [
                'label' => trans('sbco::app.coupon_code'),
                'formatter' => function ($value, $row, $index) {
                    return $row->coupon_code;
                }
            ],
            'coupon_discount' => [
                'label' => trans('sbco::app.coupon_discount'),
                'formatter' => function ($value, $row, $index) {
                    return $row->coupon_discount;
                }
            ],
            'coupon_type' => [
                'label' => trans('sbco::app.coupon_type'),
                'formatter' => function ($value, $row, $index) {
                    return ($row->coupon_type==1?'Percentage(%)':'Fixed');
                }
            ],
            'source ' => [
                'label' => trans('sbco::app.source'),
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->source ;
                }
            ],
            'created_at' => [
                'label' => trans('sbph::app.created_at'),
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ],
            
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
        $query = Coupon::query();
        $query ->whereIn('source',['survey']);
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
            case 'Coupon':
                Theme::destroy($ids);
                break;
        }
    }
}
