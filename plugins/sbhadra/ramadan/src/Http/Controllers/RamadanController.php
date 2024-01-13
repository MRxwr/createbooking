<?php

namespace Sbhadra\Ramadan\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;
use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Sbhadra\Ramadan\Http\Datatables\TimeslotDatatable;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Setting;
use Illuminate\Http\Request;

class RamadanController extends BackendController
{
    // public function index()
    // {
    //     //

    //     return view('sbra::index', [
    //         'title' => 'Title Page',
    //     ]);
    // }

    use PostTypeController;

    protected $viewPrefix = 'sbra::backend.timeslot'; // View prefix for resource

    protected function index()
    {
        $postType = $this->getSetting();
        $viewPrefix = $this->viewPrefix ?? 'juzaweb::backend.post';
        $dataTable = $this->getDataTable();
        $settings = Setting::all()->toArray();
        $config=array();
        foreach($settings as $setting){
            $config[$setting["field_key"]] = $setting["field_value"];
        }
        return view($viewPrefix . '.index', [
            'title' => $this->getTitle(),
            'postType' => $postType,
            'dataTable' => $dataTable,
            'setting' => (object)$config,
        ]);
    }

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
        return 'Ramadan Slot '; //trans('sbph::app.Timeslots');
    }
    public function settingSave(Request $request){
        $datas = $request->except('_token');
       // dd($datas);
        foreach($datas as $key=>$value){
           if (Setting::where('field_key', '=', $key)->exists()) {
               $model = Setting::firstOrNew(['field_key' => $key]);
               $model->field_value = $value;
               $model->save();
           }else{
               $model = Setting::firstOrNew(['field_key' => $key]);
               $model->field_key = $key;
               $model->field_value = $value;
               $model->save();
           } 
        }
        $res['status']=true;
           $res['data'] = array(
               'message'=>'Data successfully seved',
               'redirect'=>route('ramadan.index'),
           );
           echo json_encode($res);
    }
}
