<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterfaceController extends Controller
{

    public function showIndex(){

        return view('welcome');

    }

    public function showInterface(){

        return view('landing');

    }

    public function showConvert(){

        return view('interface');

    }

    public function showExport(){
        return view('interface_export');
    }
}
