<?php

namespace Sbhadra\Survey\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Survey\Http\Datatables\QuestionDatatable;
use Sbhadra\Survey\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends BackendController
{
   
    use PostTypeController;

    protected $viewPrefix = 'sbsu::backend.question'; // View prefix for resource

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
        $dataTable = new QuestionDatatable();
        $dataTable->mountData('question', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Question::class;
    }

    protected function getTitle()
    {
        return trans('sbsu::app.questions');
    }
    public function store(Request $request){
       
        //dd($request->all());
        $question = New Question;
        $question ->title = $request->title; 
        $question ->question_type = $request->question_type; 
        if(!empty($request->options)){
            $question ->options = json_encode($request->options);  
        }
        $question ->save();
        return $this->success([
            'message' => 'Question successfully added',
            'redirect' => route('question.index'),
        ]);

    } 
    public function destroy(Request $request,$id){
        //dd($request->all());
        $question =  Question::where('id',$id)->delete();
        
        $question ->save();
        return $this->success([
            'message' => 'Question successfully added',
            'redirect' => route('question.index'),
        ]);

    } 
}
