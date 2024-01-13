<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Photography\Http\Datatables\BranchDatatable;
use Sbhadra\Photography\Models\Branch;
use Sbhadra\Photography\Models\Service;
use Illuminate\Http\Request;

class BranchController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbph::backend.branches'; // View prefix for resource

    // Make validator for store and update
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'title' => 'required|string|max:250',
            'location' => 'required|string|max:250',
        ]);

        return $validator;
    }

    public function form($id = null) {
        $model = Branch::firstOrNew(['id' => $id]);
        if(\Auth::user()->usertype=='company'){
            $services = Service::where('company_id',\Auth::user()->id)->get(); 
        }else{
            $services = Service::all(); 
        }
        return view('sbph::backend.branches.form', [
            'model' => $model,
            'services' => $services,
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }

    public function create($id = null) {
        $model = Branch::firstOrNew(['id' => $id]);
        if(\Auth::user()->usertype=='company'){
            $services = Service::where('company_id',\Auth::user()->id)->get(); 
        }else if(\Auth::user()->id==1){
            $services = Service::all(); 
        }else{
            $services = [];
        }
        //dd($services);
        return view('sbph::backend.branches.form', [
            'model' => $model,
            'services' => $services,
            'postType'=>'branches',
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }
    public function edit($id = null) {
        $model = Branch::firstOrNew(['id' => $id]);
        if(\Auth::user()->usertype=='company'){
            $services = Service::where('company_id',\Auth::user()->id)->get(); 
        }else{
            $services = Service::all(); 
        }
        
        //dd($services);
        return view('sbph::backend.branches.form', [
            'model' => $model,
            'services' => $services,
            'postType'=>'branches',
            'title' => $model->name ?: trans('sbph::app.add_new')
        ]);
    }

    protected function afterSave(Request $request, $model){
        
        $model->services()->sync($request->services);
        @do_action('plugin.branches.update', $model);
       }
    
      protected function afterUpdate(Request $request, $model){
         // dd($request->services);
        $model->services()->sync($request->services);
        @do_action('plugin.branches.update', $model);
      }
    // Make data json for index datatable
    protected function getDataTable()
    {
        $dataTable = new BranchDatatable();
        $dataTable->mountData('branches', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Branch::class;
    }

    protected function getTitle()
    {
        return trans('sbph::app.branches');
    }
}
