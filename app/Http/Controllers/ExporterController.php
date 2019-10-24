<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\XLFExportReader;
use App\UserTranslation;

class ExporterController extends Controller
{
    public function export() {
        $uploadedXlfFile = "";
        $choosenLanguages = $_POST["languages"];

        if (isset($_FILES['file'])) {
            //dd(UserTranslation::class);
            $uploadedXlfFile = $_FILES['file']['tmp_name'];
            $fileName = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        }

        if ($uploadedXlfFile != "") {
            $translationFileLocation = $fileName;
            $userTranslation = new UserTranslation();
            $userTranslation->user_id=auth()->user()->id;
            $userTranslation->articulate_file=$fileName;
            $userTranslation->translation_name=request()->get("translation_name");
            $userTranslation->save();
            //dd($userTranslation, auth()->user());
            // create reader object and read the file
            $reader = new XLFExportReader($uploadedXlfFile, $choosenLanguages, $fileName);
            $reader->readFile();

        } else {
            die("No file");
        }
    }
}