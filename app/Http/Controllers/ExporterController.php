<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\services\XLFExportReader;
use App\UserTranslation;
use Storage;

class ExporterController extends Controller
{
    public function export(Request $request) {
        $uploadedXlfFile = "";
        $choosenLanguages = $_POST["languages"];


        //dd(UserTranslation::class);
        //dd($request);

        $uploadedXlfFile = $_FILES['xlfupload']['tmp_name'];
        $fileName = pathinfo($_FILES['xlfupload']['name'], PATHINFO_FILENAME);
        //Local storage file
        $userPath = '';
        $userPath .= '/';
        $userPath .= + Auth::User()->id;
        $userPath .= '/';  

        Storage::deleteDirectory($userPath);
        $request->file('xlfupload')->storeAs($userPath, $request->file('xlfupload')->getClientOriginalName());


        if ($uploadedXlfFile != "") {
            $translationFileLocation = $fileName;
            $userTranslation = new UserTranslation();
            $userTranslation->user_id=auth()->user()->id;
            $userTranslation->articulate_file=$fileName;
            //$userTranslation->translation_name=request()->get("translation_name");
            $userTranslation->translation_name="proba";
            $userTranslation->save();
            //dd($userTranslation, auth()->user());
            // create reader object and read the file
            $reader = new XLFExportReader($uploadedXlfFile, $choosenLanguages, $fileName);
            $reader->readFile();

            return \redirect('/');

        } else {
            die("No file");
        }

    }
}