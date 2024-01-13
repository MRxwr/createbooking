<?php

namespace Sbhadra\Photography\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;

class PhotographyController extends BackendController
{
    public function index()
    {
        //

        return view('sbph::index', [
            'title' => 'Title Page',
        ]);
    }
}
