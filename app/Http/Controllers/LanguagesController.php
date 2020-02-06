<?php

namespace App\Http\Controllers;

use App\Http\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;
use Config;

class LanguagesController extends Controller
{
    
    private $logService;
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    } 
    /**
     * Switch language function
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLanguage(Request $request) {
        try {
            // get language
            $language = $request->input("language");
            // set language to session so that we can check it in the middleware
            session_start();
            session()->put('locale', $language);
            App::setLocale($language);

        } catch (\Exception $e) {
            // add log
            $this->logService->setLog('ERROR', 'LanguagesController - switchLanguage: '. $e->getMessage());
        }
        // return to last visited page
        return back();
    }
}