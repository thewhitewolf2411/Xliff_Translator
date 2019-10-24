<?php

namespace App\Services;

ini_set("memory_limit", "1024M");
ini_set("max_execution_time", 0);


use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class XLSMatcher
{

    private $emptyFile;
    private $translationsFile;
    private $loadedEmptyFile;
    private $loadedTranslationsFile;
    private $emptyFileExtension;
    private $translationsFileExtension;
    private $emptyFileReader;
    private $translationsFileReader;
    private $writer;
    private $fileToWrite;
    private $languagesToTranslate = [];
    private $englishColumnIndex = 1;
    private $switchedIndex;
    private $sheet;
    private $type;


    public function __construct($emptyFile, $translationsFile, $sheet, $type)
    {
        $this->emptyFile = $emptyFile;
        $this->translationsFile = $translationsFile;
        $this->sheet = $sheet;
        $this->type = $type;

        // get uploaded files extensions
        $this->emptyFileExtension = pathinfo($_FILES['file']['name'][0], PATHINFO_EXTENSION);
        $this->translationsFileExtension = pathinfo($_FILES['file']['name'][1], PATHINFO_EXTENSION);
    }


    public function findMatches() {
        // set readers
        $this->setReaders();

        // load files
        $this->loadFiles();

        // loop through empty file and for each item loop through translations file to look for match
        $counter = 2;
        $emptyFileSheet = $this->loadedEmptyFile->getActiveSheet();

        $translationsFileSheet = $this->loadedTranslationsFile->getActiveSheet();

        // set headers of the new file
        $columns = range("A", "Z");
        foreach ($this->languagesToTranslate as $key => $lang) {
            $this->fileToWrite->getActiveSheet()->setCellValue($columns[$key] . "1", $lang);
            if ($key == 0) {
                $this->fileToWrite->getActiveSheet()->getColumnDimension($columns[$key])->setWidth(15);
            } else {
                $this->fileToWrite->getActiveSheet()->getColumnDimension($columns[$key])->setWidth(35);
            }
        }

        // get all terms from emptyFile - terms which are extracted from XLF file
        $terms = [];
        $termsCounter = 2;
        $termsTranslatedCounter = 0;
        while (true) {

            $value = trim($this->loadedEmptyFile->getActiveSheet()->getCell("B" . $termsCounter));

            if (!isset($value) or strlen($value) == 0) {
                break;
            }else {
                array_push($terms, $value);
            }

            $termsCounter++;
        }

        // loop through emptyFile terms and look for translations
        while (true) {

            // get current value from empty file
            if (isset($terms[$counter - 2])) {
                $value = $terms[$counter - 2];
            } else {
                break;
            }

            // if no value is set finish matching process
            if (!isset($value) or strlen($value) == 0) {
                break;
            } else {

                // when looking for a match start always from the top
                $matchingCounter = 2;

                // loop through translations file for finding match
                $this->fileToWrite->getActiveSheet()->setCellValue('A' . $counter, $counter - 1);
                $this->fileToWrite->getActiveSheet()->getStyle('A' . $counter)->getAlignment()->setWrapText(true);

                $this->fileToWrite->getActiveSheet()->setCellValue('B' . $counter, $terms[$counter - 2]); // $translationsFileSheet->getCell('B' . $counter)
                $this->fileToWrite->getActiveSheet()->getStyle('B' . $counter)->getAlignment()->setWrapText(true);

                while (true) {

                    $possibleMatch = trim($translationsFileSheet->getCell($columns[$this->englishColumnIndex] . $matchingCounter));

                    if (!isset($possibleMatch) or strlen($possibleMatch) == 0) {
                        break;
                    }

                    // additional measurements
                    $value = strip_tags($value);
                    $value = str_replace("&quot;", '"', $value);
                    $value = str_replace("&amp;", '&',  $value);
                    $value = str_replace("&#xD;", '', $value);

                    if ($value == $possibleMatch) {

                        $termsTranslatedCounter++;

                        foreach ($this->languagesToTranslate as $key => $lang) {

                            // if columns are switched
                            if ($lang == "id" && $this->englishColumnIndex != 1) {
                                $this->fileToWrite->getActiveSheet()->setCellValue($columns[$key + 2] . $counter, $translationsFileSheet->getCell($columns[$this->switchedIndex] . $matchingCounter));
                                $this->fileToWrite->getActiveSheet()->getStyle($columns[$this->switchedIndex] . $counter)->getAlignment()->setWrapText(true);
                            } else {
                                $this->fileToWrite->getActiveSheet()->setCellValue($columns[$key + 2] . $counter, $translationsFileSheet->getCell($columns[$key + 2] . $matchingCounter));
                                $this->fileToWrite->getActiveSheet()->getStyle($columns[$key + 2] . $counter)->getAlignment()->setWrapText(true);
                            }

                        }

                        // color new trnslated row
                        $this->fileToWrite->getActiveSheet()->getStyle("A" . $counter . ":" . $columns[count($this->languagesToTranslate)] . $counter)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN);

                        break;
                    }

                    $matchingCounter++;

                }

            }

            $counter++;
        }

        $filename = "translated_" . $termsTranslatedCounter . "_from_" . count($terms) . ".xlsx";

        $this->writer->save($filename);

        //header( "Location: http://localhost:8000/interface");
        $this->downloadFile($filename);
    }


    public function setReaders() {
        // depending on file extensions create appropriate file reader
        if ($this->emptyFileExtension == "xls") {
            $this->emptyFileReader = new Xls();
        } else if ($this->emptyFileExtension == "xlsx") {
            $this->emptyFileReader = new Xlsx();
        }

        if ($this->translationsFileExtension == "xls") {
            $this->translationsFileReader = new Xls();
        } else if ($this->translationsFileExtension == "xlsx") {
            $this->translationsFileReader = new Xlsx();
        }
    }


    public function loadFiles() {
        // load files to variables
        $this->loadedEmptyFile = $this->emptyFileReader->load($this->emptyFile);


        // check if it is a translation file has multiple sheets
        if ($this->type == "multiple" && strlen($this->type) > 0) {
            // TODO
            $this->loadedTranslationsFile = $this->translationsFileReader->setLoadSheetsOnly([$this->sheet]);
            $this->loadedTranslationsFile = $this->loadedTranslationsFile->load($this->translationsFile);
        } else {
            $this->loadedTranslationsFile = $this->translationsFileReader->load($this->translationsFile);
        }


        // set languages
        $this->setLanguages($this->loadedTranslationsFile);

        fopen("edited_text_to_translate.xlsx", "w");
        $this->fileToWrite = \PhpOffice\PhpSpreadsheet\IOFactory::load("edited_text_to_translate.xlsx");
        $this->writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->fileToWrite);
    }


    public function setLanguages($translations) {
        // get languages
        $languages = $translations->getActiveSheet()->toArray()[0];

        $secondColumn = "";
        foreach ($languages as $key => $lang) {
            if (strlen($lang) != 0) {
                // handle positioning "en" at second place
                if ($key == 1 && $lang != "en") {
                    array_push($this->languagesToTranslate, "en");
                    $secondColumn = $lang;
                    $this->switchedIndex = $key;
                } else if ($lang == "en" && $key != 1) {
                    array_push($this->languagesToTranslate, $secondColumn);
                    $this->englishColumnIndex = $key;
                } else {
                    array_push($this->languagesToTranslate, $lang);
                }
            }
        }

    }


    public function downloadFile($file) {
        //header("Location: /interface");

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

            // if file is downloaded delete all created files from the sistem
            $this->deleteCreatedFile($file);

            //exit;
        }
    }


    public function deleteCreatedFile($file) {
        unlink($file);
    }
}