<?php

namespace Sbhadra\Maintenance\Http\Controllers;

use Juzaweb\Http\Controllers\BackendController;

class MaintenanceController extends BackendController
{
    public function index()
    {
        //

        return view('sbma::index', [
            'title' => 'Title Page',
        ]);
    }
}
