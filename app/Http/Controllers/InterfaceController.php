<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterfaceController extends Controller
{

    public function showIndex(){

        return view('welcome');

    }

    public function showInterface($lang){

        return view('landing');

    }

    public function showConvert($lang){

        return view('interface');

    }

    public function showExport($lang){

        return view('interface_export');
    }
}
