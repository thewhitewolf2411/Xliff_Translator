<?php

namespace App\Http\Controllers;

use App\Http\Services\LogService;
use Illuminate\Http\Request;
use App;
use Session;

class InterfaceController extends Controller
{

    private $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function showIndex(){
 
        if(Session::get('locale')==null){

            $language = 'en';
            session_start();
            session()->put('locale', 'en');
            App::setlocale($language);

            return view('welcome');
        }

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
