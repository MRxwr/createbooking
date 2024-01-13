<?php

namespace Sbhadra\Slider\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Slider\Http\Datatables\SliderDatatable;
use Sbhadra\Slider\Models\Slider;

class SliderController extends BackendController
{
    use PostTypeController;

    protected $viewPrefix = 'sbsl::backend'; // View prefix for resource

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
        $dataTable = new SliderDatatable();
        $dataTable->mountData('sliders', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Slider::class;
    }

    protected function getTitle()
    {
        return trans('sbsl::app.sliders');
    }
}