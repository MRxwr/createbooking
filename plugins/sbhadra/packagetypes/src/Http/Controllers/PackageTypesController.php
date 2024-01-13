<?php

namespace Sbhadra\Packagetypes\Http\Controllers;
use Juzaweb\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Packagetypes\Http\Datatables\PackagetypeDatatable;
use Sbhadra\Packagetypes\Models\PackageType;
use Sbhadra\Packagetypes\Models\PackageTypeAttribute;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Illuminate\Http\Request;


class PackageTypesController extends BackendController
{
    use ResourceController;
    
    protected $viewPrefix = 'sbpt::backend.types'; // View prefix for resource

    protected function index(){
        $dataTable = $this->getAttrDataTable();
        return view('sbpt::backend.types.index', [
            'title' =>$this->getTitle(),
            'dataTable' => $dataTable, 
        ]);
    }
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'title' => 'required|string|max:250',
        ]);

        return $validator;
    }
   
    protected function store(Request $request){
        if(isset($request->title)){
            $type = new PackageType;
            $type->title = $request->title;
            $type->ptype = $request->ptype;
            $type->note = $request->note;
            $type->status = $request->status;
            if($type->save()){
                return $this->success([
                    'message' => 'Package Type Successfully added',
                    'redirect' => route('admin.package-type.index'),
                ]);
            }

        }
    }

    protected function edit($id){
        $dataTable = $this->getAttrDataTable();
        $model = PackageType::find($id);
        return view('sbpt::backend.types.form', [
            'title' =>$this->getTitle(),
            'model' =>$model,
            'dataTable' => $dataTable, 
        ]);
    }

    // protected function update(Request $request,$id){
    //     //dd($request->all());
    //     if(isset($request->title)){
    //         $type =  PackageType::find($id);
    //         $type->title = $request->title;
    //         $type->status = $request->status;
    //         if($type->save()){
    //             return $this->success([
    //                 'message' => 'Package Type Successfully Update',
    //                 'redirect' => route('admin.package-type.index'),
    //             ]);
    //         }

    //     }
    // }
    public function attributes($id){
        $dataTable = $this->getAttrDataTable();
        return view('sbpt::backend.types.index', [
            'title' => 'Attributes of xxx',
            'dataTable' => $dataTable,
            
        ]);

    }
    public function attributeStore(Request $request,$id){

    }
   
     // Make data json for index datatable
     protected function getDataTable()
     {
         
         return new PackagetypeDatatable();
     }
 
     // Make data json for index datatable
     protected function getAttrDataTable()
     {
         
         return new PackagetypeDatatable();
     }
 
     protected function getModel()
     {
         return PackageType::class;
     }
 
     protected function getTitle()
     {
         return 'Package Types';
     }
     
}
