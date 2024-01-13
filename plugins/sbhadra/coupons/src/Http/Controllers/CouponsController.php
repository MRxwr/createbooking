<?php

namespace Sbhadra\Coupons\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Coupons\Http\Datatables\CouponDatatable;
use Sbhadra\Coupons\Models\Coupon;
use Illuminate\Http\Request;

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
    protected function afterSave(Request $request, $model){
        if($request['source']=='survey'){
            $today= date('Y-m-d');
            $coupon_discount = 0.00;
            $coupon_type = 2;
            $source = 'survey';
            $model->source =$source;
            $model->coupon_discount =0.00;
            $model->coupon_type =$coupon_type;
            $model->validity_from =  $today;
            $model->validity_to = date('Y-m-d', strtotime($today . ' +365 day'));
        }

        $model->save();
    }
}
