<?php

namespace App\Http\Controllers;

use Storage;
use Auth;
use Illuminate\Http\Request;
use App\services\XLFReader;

class ConvertorController extends Controller
{
    public function convert(Request $request) {
        // koristi $request umjesto $_POST
        if(isset($_POST['submit'])){

            $uploadedXlsFile = "";
            $uploadedXlfFile = "";
            $xlsFileExtension = "";
            $xlfFileName = "";
            $xlsFileSheetName = trim($request["sheet"]);
            $fileType = 'single';

            if (isset($_POST["demo"])) {
                $demo = $_POST["demo"];
            } else {
                $demo = true;
            }

            $userPath = '';
            $userPath .= '/';
            $userPath .= + Auth::User()->id;
            $userPath .= '/';
    
            $file = Storage::allFiles($userPath);
            $secondFileExtension = pathinfo($file[0], PATHINFO_EXTENSION);
            $request->file('xlsupload')->storeAs($userPath, $request->file('xlsupload')->getClientOriginalName());
            $firstFileExtension = $request->file('xlsupload')->extension();

            $files = Storage::allFiles($userPath);

            // check files extensions
            if (($firstFileExtension == "xls" or $firstFileExtension == "xlsx") && $secondFileExtension == "xlf") {
    
                /*$uploadedXlsFile = $_FILES['xlsupload']['tmp_name'][0];
                $uploadedXlfFile = $_FILES['xlsupload']['tmp_name'][1];
                $xlsFileExtension = $firstFileExtension;
                $xlfFileName = pathinfo($_FILES['xlsupload']['name'][1], PATHINFO_FILENAME);*/
                $uploadedXlfFile = $files[0];
                $uploadedXlsFile = $files[1];
                $xlsFileExtension = $firstFileExtension;
                $xlfFileName = pathinfo($file[0], PATHINFO_FILENAME);
                
    
            } else if (($secondFileExtension == "xls" or $secondFileExtension == "xlsx") && $firstFileExtension == "xlf") {
    
                $uploadedXlsFile = $_FILES['xlsupload']['tmp_name'][1];
                $uploadedXlfFile = $_FILES['xlsupload']['tmp_name'][0];
                $xlsFileExtension = $secondFileExtension;
                $xlfFileName = pathinfo($_FILES['xlsupload']['name'][0], PATHINFO_FILENAME);
    
            } else {
                die("Invalid files");
            }
    
            // depending on XLS extension create appropriate file reader object
            if ($xlsFileExtension == "xls") {
                // create reader object and read uploaded file
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
    
            // create reader object
            $reader = new XLFReader($reader, $uploadedXlsFile, $uploadedXlfFile, $fileType, $xlsFileSheetName, $demo, $xlfFileName);
            $reader->readImportedFile();

        }

        else{
            echo 'You should select a file to upload';
        }

    }
}
