<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\ServiceDatatable;
use Sbhadra\Photography\Models\Service;

class ServiceController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.service'; // View prefix for resource

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
        $dataTable = new ServiceDatatable();
        $dataTable->mountData('services', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Service::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.services');
    }
}
