<?php

namespace Juzaweb\Translation\Http\Controllers;

use Juzaweb\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;


class LangsController extends FrontendController
{
    public function index(Request $request){
        dd($request->all());
    }

}
