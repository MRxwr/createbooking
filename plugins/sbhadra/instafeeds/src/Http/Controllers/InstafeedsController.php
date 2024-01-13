<?php

namespace Sbhadra\Instafeeds\Http\Controllers;

use Juzaweb\Traits\PostTypeController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\Http\Controllers\BackendController;
use Sbhadra\Instafeeds\Http\Datatables\InstaFeedsDatatable;
use Sbhadra\Instafeeds\Models\FeedGallery;

class InstafeedsController extends BackendController
{
    use PostTypeController;

    protected $viewPrefix = 'sbin::backend.gallery'; // View prefix for resource

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
        $dataTable = new InstaFeedsDatatable();
        $dataTable->mountData('instafeed', 0);
        return $dataTable;
    }

    protected function getModel()
    {
        return FeedGallery::class;
    }

    protected function getTitle()
    {
        return trans('sbin::app.instafeed');
    }
}
