<?php

namespace Sbhadra\Survey\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Survey\Http\Datatables\CouponDatatable;
use Sbhadra\Coupons\Models\Coupon;

class CouponsController extends BackendController
{
    use PostTypeController;

    protected $viewPrefix = 'sbco::backend.coupon'; // View prefix for resource

    // Make validator for store and update
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'title' => 'required|string|max:250',
        ]);

        return $validator;
    }

    // Make data json for index datatable
    protected function getDataTable()
    {
        $dataTable = new CouponDatatable();
        $dataTable->mountData('coupons', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Coupon::class;
    }

    protected function getTitle()
    {
        return trans('sbco::app.coupons');
    }
}
