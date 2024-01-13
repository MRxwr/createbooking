<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */
namespace Juzaweb\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Juzaweb\Http\Controllers\BackendController;
use Juzaweb\Http\Datatables\UserDataTable;
use Juzaweb\Models\User;
use Juzaweb\Models\UserConfig;
use Juzaweb\Traits\ResourceController;
use Sbhadra\Calendar\Models\CalendarSetting;

class UserController extends BackendController
{
    use ResourceController;

    protected $viewPrefix = 'juzaweb::backend.user';

    /**
     * Validator for store and update
     *
     * @param array $attributes
     * @return \Illuminate\Support\Facades\Validator|array
     */
    protected function validator(array $attributes)
    {
        $allStatus = array_keys(User::getAllStatus());

        return [
            'name' => 'required|string|max:250',
            'username' => 'required_if:id,|string|max:199|unique:users',
            'password' => 'required_if:id,',
            'avatar' => 'nullable|string|max:150',
            'email' => 'required_if:id,|unique:users,email',
            'status' => 'required|in:' . implode(',', $allStatus),
        ];
    }

    /**
     * Get model resource
     *
     * @return string
     */
    protected function getModel()
    {
        return User::class;
    }

    /**
     * Get title resource
     *
     * @return string
     **/
    protected function getTitle()
    {
        return trans('juzaweb::app.users');
    }

    /**
     * Get data table resource
     *
     * @return \Juzaweb\Abstracts\DataTable
     */
    protected function getDataTable()
    {
        return new UserDataTable();
    }

    protected function getDataForForm($model)
    {
        $allStatus = User::getAllStatus();

        return [
            'model' => $model,
            'allStatus' => $allStatus,
        ];
    }

    /**
     * After Save model
     *
     * @param Request $request
     * @param \Juzaweb\Models\Model $model
     */
    protected function afterSave(Request $request, $model)
    {
        $model->setAttribute('is_admin', $request->post('is_admin', 0));

        if ($request->post('password')) {
            $request->validate([
                'password' => 'required|string|max:32|min:8|confirmed',
                'password_confirmation' => 'required|string|max:32|min:8',
            ], [], [
                'password' => trans('juzaweb::app.password'),
                'password_confirmation' => trans('juzaweb::app.confirm_password'),
            ]);

            $model->setAttribute('password', Hash::make($request->post('password')));
        }

        if(!empty($request->post('permission'))){
            $permision = json_encode($request->post('permission'));
            $model->setAttribute('permissions', $permision);
        }

        if($request->post('usertype')){
            if($request->post('usertype')=='admin'){
                $model->setAttribute('is_admin', 1);
            }else if($request->post('usertype')=='employee'){
                $model->setAttribute('is_admin', 1);
            }else if($request->post('usertype')=='company'){
                $model->setAttribute('is_admin', 1);
            }else{
                $model->setAttribute('is_admin', 0);  
            }
            $model->setAttribute('usertype', $request->post('usertype'));
        }
        if($model->save() && $model->usertype=='company'){
            $setting = CalendarSetting::where('user_id',$model->id)->first();
             if(!$setting){
                $setting = new CalendarSetting;
                $setting ->start_date = '2023-03-04';
                $setting ->end_date = '2023-06-30';
                $setting ->close_days = '["5","6"]';
                $setting ->cwith_days =1;
                $setting ->status ='yes';
                $setting ->user_id =$model->id;
                $setting ->save();
             }
            
        }
    }

    public function config($id){
        $user = User::find($id);
        //dd($user);
        return view('juzaweb::backend.user.config', [
            'title' => trans('juzaweb::app.system_setting'),
            'user' => $user,
            'config' => $user->config,
        ]);
    }
    public function configSave(Request $request,$id){
        $company_id=$request->user_id;
        $configs = $request->except(['user_id']);
        foreach ($configs as $key => $config){
            if( $uConfig = UserConfig::where('code',$key)->where('company_id',$company_id)->first()){
              $conf= UserConfig::find($uConfig->id);
              $conf->value = $config;
              $conf->save();
            }else{
                $conf= new UserConfig;
                $conf->code = $key;
                $conf->value = $config;
                $conf->company_id = $company_id;
                $conf->save();
            }
        }
        //$uConfig =UserConfig::where('code',)
        return $this->success([
            'message' => trans('juzaweb::app.saved_successfully'),
            'redirect' => route('admin.users.config', ['id'=>$company_id]),
        ]);
    }
}
