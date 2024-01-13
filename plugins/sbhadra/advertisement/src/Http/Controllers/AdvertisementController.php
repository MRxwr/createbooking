<?php

namespace Sbhadra\Advertisement\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;
use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Sbhadra\Advertisement\Http\Datatables\AdvertisDatatable;
use Sbhadra\Advertisement\Models\Advertise;

class AdvertisementController extends BackendController
{
    use PostTypeController;

    protected $viewPrefix = 'sbad::backend'; // View prefix for resource

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
        $dataTable = new AdvertisDatatable();
        $dataTable->mountData('advertise', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Advertise::class;
    }

    protected function getTitle()
    {
        return trans('sbad::app.advertise');
    }
}
