<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\TimeslotDatatable;
use Sbhadra\Photography\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends BackendController
{ 
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.timeslot'; // View prefix for resource

    // Make validator for store and update
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'starttime' => 'required|string|max:250',
            'endtime' => 'required|string|max:250',
        ]);

        return $validator;
    }

    // Make data json for index datatable
    protected function getDataTable()
    {
        $dataTable = new TimeslotDatatable();
        $dataTable->mountData('timeslots', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Timeslot::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.Timeslots');
    }
    
    protected function afterSave(Request $request, $model){
        if(isset($request->slot_type)){
            $model->slot_type =  $request->slot_type;
        }
        $model->save();
    }
}
