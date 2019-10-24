<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\XLFReader;

class ConvertorController extends Controller
{
    public function convert() {

        $uploadedXlsFile = "";
        $uploadedXlfFile = "";
        $xlsFileExtension = "";
        $xlfFileName = "";
        $xlsFileSheetName = trim($_POST["sheet"]);
        $fileType = trim($_POST["sheet_type"]);

        // check if is demo sample or not
        if (isset($_POST["demo"])) {
            $demo = $_POST["demo"];
        } else {
            $demo = true;
        }
        //$download = DB::table('')->all();
        // get extensions
        $firstFileExtension = strtolower(pathinfo($_FILES['file']['name'][0])['extension']);
        $secondFileExtension = strtolower(pathinfo($_FILES['file']['name'][1])['extension']);

        // check files extensions
        if (($firstFileExtension == "xls" or $firstFileExtension == "xlsx") && $secondFileExtension == "xlf") {

            $uploadedXlsFile = $_FILES['file']['tmp_name'][0];
            $uploadedXlfFile = $_FILES['file']['tmp_name'][1];
            $xlsFileExtension = $firstFileExtension;
            $xlfFileName = pathinfo($_FILES['file']['name'][1], PATHINFO_FILENAME);

        } else if (($secondFileExtension == "xls" or $secondFileExtension == "xlsx") && $firstFileExtension == "xlf") {

            $uploadedXlsFile = $_FILES['file']['tmp_name'][1];
            $uploadedXlfFile = $_FILES['file']['tmp_name'][0];
            $xlsFileExtension = $secondFileExtension;
            $xlfFileName = pathinfo($_FILES['file']['name'][0], PATHINFO_FILENAME);

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
}
