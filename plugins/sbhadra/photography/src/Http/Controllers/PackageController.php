<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\PackageDatatable;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Branch;
use Illuminate\Http\Request;
use Auth;
class PackageController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.package'; // View prefix for resource

    public function form($id = null) {
        $model = Package::firstOrNew(['id' => $id]);
       
        if(Auth::user()->usertype=='company'){
            
            $branches = Branch::where('company_id', \Auth::user()->id)->get();
           $timeslots = Timeslot::where('company_id', \Auth::user()->id)->get();
        }else{
            $branches = Branch::all();
           $timeslots = Timeslot::all();  
        }
        return view('sbph::backend.package.form', [
            'model' => $model,
            
            'branches' => $branches,
            'timeslots' => $timeslots,
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }

    public function create($id = null) {
        
        $model = Package::firstOrNew(['id' => $id]);
        if(Auth::user()->usertype=='company'){
            
            $branches = Branch::where('company_id', \Auth::user()->id)->get();
           $timeslots = Timeslot::where('company_id', \Auth::user()->id)->get();
        }else{
            $branches = Branch::all();
           $timeslots = Timeslot::all();  
        }
        
        //dd($services);
        return view('sbph::backend.package.form', [
            'model' => $model,
            'branches' => $branches,
            'timeslots' => $timeslots,
            'postType'=>'package',
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }
    public function edit($id = null) {
        $model = Package::firstOrNew(['id' => $id]);
        if(Auth::user()->usertype=='company'){
           
            $branches = Branch::where('company_id', \Auth::user()->id)->get();
           $timeslots = Timeslot::where('company_id', \Auth::user()->id)->get();
        }else{
            $branches = Branch::all();
           $timeslots = Timeslot::all();  
        }
        //dd($services);
        return view('sbph::backend.package.form', [
            'model' => $model,
            'branches' => $branches,
            'timeslots' => $timeslots,
            'postType'=>'package',
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }
    protected function afterSave(Request $request, $model){
        $model->normal_period = $request->normal_period;
        $model->album_period = $request->album_period;
        $model->branches()->sync($request->branches);
        $model->slots()->sync($request->slots);
        @do_action('plugin.package.update', $model);
       }
    
      protected function afterUpdate(Request $request, $model){
         // dd($request->services);
        $model->normal_period = $request->normal_period;
        $model->album_period = $request->album_period;
        $model->branches()->sync($request->branches);
        $model->slots()->sync($request->slots);
        @do_action('plugin.package.update', $model);
      }
    protected function beforeUpdate(Request $request, $model, ...$params)
    {
        //
    }

 
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
        $dataTable = new PackageDatatable();
        $dataTable->mountData('packages', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Package::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.packages');
    }
}
