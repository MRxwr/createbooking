<?php
namespace Sbhadra\Maintenance\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Photography\Models\Setting;
use Illuminate\Support\Facades\DB;

class MainAction extends Action
{
    public function handle()
    {

        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addDoMaintenanceAction']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addConfigMaintenanceAction']);
        //$this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addDoMaintenanceAction']);

    }

    public function addDoMaintenanceAction(){
        
        if($this->isMaintenance()){
            $settings = Setting::all()->toArray();
            $config=array();
            foreach($settings as $setting){
                $config[$setting["field_key"]] = $setting["field_value"];
            }
            //dd($config);
           echo $html = view('sbma::index', compact('config'))->render();

            die();
        }
    }
    public function addConfigMaintenanceAction(){
        HookAction::addAdminMenu(
            'Maintenance',
            'setting/maintenance',
            [
                'icon' => 'fa fa-cog',
                'position' => 25,
                'parent' => 'setting',
            ]
        );
    }


    static function isMaintenance(){
        $settings = Setting::where('field_key','is_maintenance')->first();
        if(  $settings->field_value ==1){
            return true;
        }else{
            return false;
        }
    }


}