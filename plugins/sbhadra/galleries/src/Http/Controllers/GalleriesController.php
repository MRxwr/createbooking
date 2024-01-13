<?php

namespace Sbhadra\Galleries\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Galleries\Http\Datatables\GalleryDatatable;
use Sbhadra\Galleries\Models\Gallery;

class GalleriesController extends BackendController
{
    use PostTypeController;

    protected $viewPrefix = 'sbga::backend.gallery'; // View prefix for resource

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
        $dataTable = new GalleryDatatable();
        $dataTable->mountData('galleries', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return Gallery::class;
    }

    protected function getTitle()
    {
        return trans('sbga::app.galleries');
    }
}
