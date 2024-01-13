<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\CompletedBookingDatatable;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Illuminate\Http\Request;

class CompletedBookingController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.booking'; // View prefix for resource

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
        $dataTable = new CompletedBookingDatatable();
        $dataTable->mountData('bookings', 0);
        return $dataTable;
    }


    protected function getModel()
    {
        return Booking::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.bookings');
    }

   
}

