<?php

namespace Sbhadra\Packagetypes\Http\Controllers;
use Juzaweb\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Packagetypes\Http\Datatables\PackagetypeAttrDatatable;
use Sbhadra\Packagetypes\Models\PackageType;
use Sbhadra\Packagetypes\Models\PackageTypeAttribute;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Illuminate\Http\Request;


class PackageTypesAttrController  extends BackendController
{
    use ResourceController;
    
    protected $viewPrefix = 'sbpa::backend.attr'; // View prefix for resource

    protected function index(Request $request){
        $id = $request->id;
          $type = PackageType::find($id);
          $dataTable = PackageTypeAttribute::where('package_type_id', $request->id)->get();
         
          return view('sbpt::backend.attr.index', [
                'title' =>$type->title.'\'s-'.$this->getTitle(),
                'package_type_id'=>$id,
                'type_title' => $type->title,
                'dataTable' => $dataTable, 
        ]);
    }

    // Make validator for store and update
    protected function validator(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'title' => 'required|string|max:250',
        ]);

        return $validator;
    }
    public function store(Request $request){
        if(isset($request->name)){
            $type = new PackageTypeAttribute;
            $type->title = $request->name;
            $type->package_type_id = $request->package_type_id;
            $type->price = $request->price;
            $type->is_theme = $request->is_theme;
            $type->status = $request->status;
            if($type->save()){
                return $this->success([
                    'message' => 'Attribute Successfully added',
                    'redirect' => route('admin.package-type-attributes.index',['id'=>$request->package_type_id]),
                ]);
            }

        }
    }

    protected function edit(Request $request,$id){
          $model = PackageTypeAttribute::find($id);
          $type = PackageType::find($model->package_type_id);
          $dataTable = PackageTypeAttribute::where('package_type_id', $model->package_type_id)->get();
          return view('sbpt::backend.attr.form', [
            'title' =>$this->getTitle(),
            'type_title' => $type->title,
            'model' =>$model,
            'dataTable' => $dataTable, 
        ]);
    }
    // protected function update(Request $request,$id){
    //     if(isset($request->name)){
    //         $type = PackageTypeAttribute::find($id);
    //         $type->title = $request->name;
    //         $type->price = $request->name;
    //         $type->status = $request->status;
    //         if($type->save()){
    //             return $this->success([
    //                 'message' => 'Package Type Successfully added',
    //                 'redirect' => route('admin.package-type.index'),
    //             ]);
    //         }

    //     }
    // }
   
   
     // Make data json for index datatable
     protected function getDataTable($request)
     {
        $dataTable = new PackagetypeAttrDatatable();
        return $dataTable;
    }
 
     
 
     protected function getModel()
     {
         return PackageTypeAttribute::class;
     }
 
     protected function getTitle()
     {
         return 'Attributes';
     }
     
}
