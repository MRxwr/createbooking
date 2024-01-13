<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends BackendController
{
    public function index(Request $request)
    {
        
        $settings = Setting::all()->toArray();
        $config=array();
        foreach($settings as $setting){
            $config[$setting["field_key"]] = $setting["field_value"];
        }
        return view('sbph::backend.setting.index', [
            'settings' => $config,
            'title' => 'Booking Settings'
        ]);
    }

    public function save(Request $request)
    {
        $datas = $request->except('_token');
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
                'redirect'=>route('admin.setting.get'),
            );
            echo json_encode($res);
        
    }
}
