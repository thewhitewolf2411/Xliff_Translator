<?php

namespace App\Services;

// files with lot of languages to translate need more than 30s to execute
use PhpOffice\PhpSpreadsheet\Exception;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;

ini_set("max_execution_time", 0);

class XLFReader
{
    private $reader;
    private $file;
    private $xlsFile;
    private $xlfFile;
    private $sheetName;
    private $fileType;
    private $xlfFileName;
    private $demo = true;
    private $translatedTermsCounter = 0;
    private $foundMatchingTerms = 0;
    private $fileNames = [];

    private $englishTranslation = [];
    private $germanTranslation = [];
    private $spanishTranslation = [];
    private $russianTranslation = [];
    private $czechTranslation = [];
    private $italianTranslation = [];
    private $frenchTranslation = [];
    private $chineseTranslation = [];
    private $portugalTranslation = [];
    private $polandTranslation = [];
    private $holandTranslation = [];

    private $currentFileNumber = 0;
    private $currentTranslation;
    private $availableLanguages = [];
    private $languageIndexCounter = 1; // because id is at 0


    public function __construct($reader, $xlsFile, $xlfFile, $fileType, $sheetName, $demo, $xlfName)
    {
        $this->reader = $reader;
        $this->xlsFile = $xlsFile;
        $this->xlfFile = $xlfFile;
        $this->xlfFileName = $xlfName;
        $this->sheetName = $sheetName;
        $this->fileType = $fileType;
        $this->demo = $demo;

        /*//$this->file = file_get_contents($this->xlfFile);
        $path = "C:/xampp/htdocs/xls_xlf_final/storage/app/".$xlsFile;
        $this->file = File::get($path);
        $userPath = '';
        $userPath .= '/';
        $userPath .= + Auth::User()->id;
        $userPath .= '/';*/

        //$this->file = file_get_contents("C:/xampp/htdocs/xls_xlf_final/storage/app/".$this->xlfFile);
        
        $this->file = File::get("../storage/app/".$this->xlfFile);

    }


    /**
     * Read uploaded XLS file
     */
    public function readImportedFile() {

        try {

            // read wanted sheet from imported file
            if ($this->fileType == "single") {

            } else if ($this->fileType == "multiple" && strlen($this->sheetName) > 0) {
                $this->reader->setLoadSheetsOnly([$this->sheetName]);
            } else {
                exit("Unspecified XLS file type or sheet name.");
            }

            // load sheet
            
            //$spreadsheet = $this->reader->load(File::get("C:/xampp/htdocs/xls_xlf_final/storage/app/".$this->xlsFile));
            //$spreadsheet = $this->reader->load($this->file);
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../storage/app/".$this->xlsFile);
            $numberOfSheets = $spreadsheet->getSheetCount();
            
            // CHECKING VALIDITY
            // if number of sheets is greater than 1 and type is single throw exception
            if ($this->fileType == "single" && $numberOfSheets > 1) {
                throw new Exception("Number of sheets is greater than 1 but selected file type is 'single'.");
            }

//            else if ($this->fileType == "multiple" && $numberOfSheets == 1) {
//                throw new Exception("Number of sheets is  1 but selected file type is 'multiple'.");
//            }

            // convert readed sheet into array
            $dataArray = $spreadsheet->getActiveSheet()->toArray();

            // get first row of the sheet (column headings)
            $columnHeadings = $dataArray[0];
            // check if column headings are set properly
            if (count($columnHeadings) < 3 && array_search("en", $columnHeadings)) {
                throw new Exception("Selected sheet needs to have at least two columns and one of them needs to be 'en'.");
            }

            // read language values
            $this->readLanguageValues($columnHeadings, $spreadsheet);

        } catch (Exception $e) {
            die("Exception: " . $e->getMessage());
        }

    }


    /**
     * Read language values by columns
     *
     * @param $columnHeadings
     * @param $spreadsheet
     */
    public function readLanguageValues($columnHeadings, $spreadsheet) {

        // define all columns from A to Z
        $columns = range('A', 'Z');

        // CHECK WHICH LANGUAGE COLUMNS EXIST AND FIND THEIR INDEXES
        $this->setLanguageColumns($columnHeadings);

        // set counter from 2 because first row are column headers
        $counter = 2;
        while (true) {

            $currentEnglishValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("en", $this->availableLanguages)] . $counter);

            // check if the row is empty, if yes break from the loop
            if (isset($currentEnglishValue) && strlen($currentEnglishValue) > 0) {

                // add german translation
                if (array_search("de", $this->availableLanguages)) {
                    $currentGermanValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("de", $this->availableLanguages)] . $counter);
                    array_push($this->germanTranslation, $currentGermanValue);
                }

                // add english translation
                if (array_search("en", $this->availableLanguages)) {
                    array_push($this->englishTranslation, $currentEnglishValue);
                }

                // spanish language
                if (array_search("es", $this->availableLanguages)) {
                    $currentSpanishValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("es", $this->availableLanguages)] . $counter);
                    array_push($this->spanishTranslation, $currentSpanishValue);
                }

                // add czech translation
                if (array_search("cs", $this->availableLanguages)) {
                    $currentCzechValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("cs", $this->availableLanguages)] . $counter);
                    array_push($this->czechTranslation, $currentCzechValue);
                }

                // add italian translation
                if (array_search("it", $this->availableLanguages)) {
                    $currentItalianValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("it", $this->availableLanguages)] . $counter);
                    array_push($this->italianTranslation, $currentItalianValue);
                }

                // add french translation
                if (array_search("fr", $this->availableLanguages)) {
                    $currentFrenchValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("fr", $this->availableLanguages)] . $counter);
                    array_push($this->frenchTranslation, $currentFrenchValue);
                }

                // add chinese translation
                if (array_search("zh", $this->availableLanguages)) {
                    $currentChineseValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("zh", $this->availableLanguages)] . $counter);
                    array_push($this->chineseTranslation, $currentChineseValue);
                }

                // add russian translation
                if (array_search("ru", $this->availableLanguages)) {
                    $currentRussianValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("ru", $this->availableLanguages)] . $counter);
                    array_push($this->russianTranslation, $currentRussianValue);
                }

                // add portugal translation
                if (array_search("pt", $this->availableLanguages)) {
                    $currentPortugalValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("pt", $this->availableLanguages)] . $counter);
                    array_push($this->portugalTranslation, $currentPortugalValue);
                }

                // add poland translation
                if (array_search("pl", $this->availableLanguages)) {
                    $currentPolandValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("pl", $this->availableLanguages)] . $counter);
                    array_push($this->polandTranslation, $currentPolandValue);
                }

                // add holand translation
                if (array_search("nl", $this->availableLanguages)) {
                    $currentHolandValue = $spreadsheet->getActiveSheet()->getCell($columns[array_search("nl", $this->availableLanguages)] . $counter);
                    array_push($this->holandTranslation, $currentHolandValue);
                }

            } else {

                break;

            }

            $counter++;

        }


        // set language translations into array and loop for each one
        $languages = ["en" => $this->englishTranslation,"de" => $this->germanTranslation,  "it" => $this->italianTranslation, "es" => $this->spanishTranslation,
              "fr" => $this->frenchTranslation, "zh" => $this->chineseTranslation, "pt" => $this->portugalTranslation,
             "pl" => $this->polandTranslation, "cs" => $this->czechTranslation, "nl" => $this->holandTranslation, "ru" => $this->russianTranslation];

        // loop through all languages and make translations
        foreach ($languages as $key => $lang) {

            if (!empty($lang)) {

                // dont translate english language
                if ($this->availableLanguages[$this->languageIndexCounter] == "en") {
                    $this->languageIndexCounter++; 
                    continue;
                }

                // reset terms translated counter
                $this->foundMatchingTerms = 0;

                // set currently translating language
                $this->currentTranslation = $lang;
                $this->currentFileNumber++;
                $this->writeTranslationsToXlfFile($key); // $this->availableLanguages[$this->languageIndexCounter]

                // echo $this->availableLanguages[$this->languageIndexCounter] ."<br/>";
                $this->languageIndexCounter++;
            }

        }

        // download all created files as ZIP file
        // die("END");
        $this->createZipFile();
    }


    /**
     * Set all languages that appear in the file
     * @param $columnHeadings
     */
    public function setLanguageColumns($columnHeadings) {
        // loop through column headings and set all languages to translate
        foreach ($columnHeadings as $column) {

            if (strlen($column) == 2) { //  && $column != "id"
                array_push($this->availableLanguages, $column);
            }
        }

    }


    /**
     * Write translations to the XLF file
     */
    public function writeTranslationsToXlfFile($lang) {
        // first add appropriate target-language="" to the file
        $file = $this->file;
        $file = $this->addTargetLanguage($file, $lang);

        $this->findTransUnitAndAddTargets($file, 0, $lang);
    }


    public function addTargetLanguage($file, $lang) {
        // find position of source-language
        $sourceLanguagePosition = strpos($file, "source-language=", 0);

        // find next " " after source language
        $emptySpacePosition = strpos($file, " ", $sourceLanguagePosition);

        // at empty space insert target-element attribute
        $stringToAdd = ' target-language="' . $lang . '" ';

        $file = substr_replace($file, $stringToAdd, $emptySpacePosition, 1);

        //die($file);
        return $file;
    }


    /**
     * Finding trans-unit inside the file and adding target elements if necessary
     *
     * @param $file
     * @param $position
     */
    public function findTransUnitAndAddTargets($file, $position, $lang) {

        $demoCounter = 0;

        while (strpos($file, "<trans-unit", $position) != false) {

            // find position of next opening <trans-unit> tag
            $posOpen = strpos($file, "<trans-unit", $position);

            // find position of next closing </trans-unit> tag and add necessary number of characters
            $posClose = strpos($file, "</trans-unit>", $posOpen) + 13;

            $transUnit = substr($file, $posOpen, ($posClose - $posOpen));
            $oldTransUnit = $transUnit;

            if (strlen($oldTransUnit) > 10) {

                // check if this substring has <g> element which contains text to translate
                if (strpos($oldTransUnit, "</g>") != false) {

                    // create target element
                    $targetElement = $this->createTargetElement($transUnit);

                    // put target element inside <trans-unit> element
                    if ($this->translatedTermsCounter > 0){
                        $transUnit = $this->addTargetElement($transUnit, $targetElement);

                        // replace old trans unit with the new one
                        $file = substr_replace($file, $transUnit, $posOpen, strlen($oldTransUnit)); //str_replace($oldTransUnit, $transUnit, $file);

//                        $demoCounter++;
//
//                        // if this is a demo sample exit translation after 10 translations are made
//                        if ($this->demo == true && $demoCounter == 15) {
//                            break;
//                        }
                    }
                }
            }
            $position = $posClose;
        }

        $filepath = "translations/" . $this->xlfFileName . "-" . strtoupper($lang) . "-" . $this->foundMatchingTerms . ".xlf";

        array_push($this->fileNames, $filepath);

        file_put_contents($filepath, $file);
    }


    /**
     * Creating target element
     *
     * @param $unit
     * @return mixed
     */
    public function createTargetElement($unit) {
        // remove trans unit tags
        $closingTransUnitTag = strpos($unit, ">") + 1;
        $unit = substr_replace($unit,"",0, $closingTransUnitTag);
        $unit = str_replace("</trans-unit>", "", $unit);

        // replace source with target
        $unit = str_replace("<source>", "<target state='translated'>", $unit);
        $unit = str_replace("</source>", "</target>", $unit);

        // check if unit contains bullets
        $bullets = strpos($unit, 'ListType="Bullet"');

        // handle <g> elements - find if they are empty or the need to be translated with translation text
        $unit = $this->handleGElements($unit, $bullets);

        return $unit;
    }


    /**
     * Handling <g> elements inside target element
     *
     * @param $unit
     * @return mixed
     */
    public function handleGElements($unit, $bullets) {
        // reset g counter
        $this->translatedTermsCounter = 0;

        // find <g> elements which has text inside opening and closing tag
        $position = 0;
        while (strpos($unit, "<g", $position) != false) {

            // current <g position
            $position = strpos($unit, "<g", $position);

            $currentPosition = $position;

            $position++;

            // find next '>'
            $closingTag = strpos($unit, ">", $position);

            // check if it is an empty /> element
            /*if (substr($unit, ($closingTag - 1), 1) == "/"
                or substr($unit, ($closingTag + 1), 1) == "<"
                or substr($unit, ($closingTag + 1), 1) == "&") {
                // continue with next iteration - this is an empty <g> element
                continue;

            } else {
                // replace whole <g> element with translation if exists
                // find next '</g>' which closes current G element
                $closingTag = strpos($unit, "</g>", $position) + 4;

                $toReplace = substr($unit, $currentPosition, ($closingTag - $currentPosition));

                // get exact value which needs to be translated
                $unit = $this->extractValueFromSubstring($unit, $toReplace, $bullets);
            }
                */

                $closingTag = strpos($unit, "</g>", $position) + 4;

                $toReplace = substr($unit, $currentPosition, ($closingTag - $currentPosition));
                
                // get exact value which needs to be translated
                $unit = $this->extractValueFromSubstring($unit, $toReplace, $bullets);

        }

        return $unit;
    }


    public function addTargetElement($transUnit, $targetElement) {
        // remove closing trans-unit - it will be added again
        $transUnit = str_replace("</trans-unit>", "", $transUnit);

        // add targetElement after closing source tag
       // $transUnit = "\n" . $transUnit;
        $transUnit .= $targetElement;
        $transUnit .= "</trans-unit>";

        return $transUnit;
    }


    public function extractValueFromSubstring($unit, $toReplace, $bullets) {
        // starting text position
        $posStart = strpos($toReplace, ">", 0) + 1;

        // ending text position
        $posEnd = strpos($toReplace, "</g>", 0);

        $textToReplace = substr($toReplace, $posStart, ($posEnd - $posStart));
        $oldTextToReplace = $textToReplace;
        //here!
        //$textToReplace .= "<br>";
        if(substr($oldTextToReplace, -1) == " " || substr($oldTextToReplace, -1) == "\n"){
            $textToReplace = $this->findReplacementWord($textToReplace) . "\n" ."\n";
        }
        else{
        // find appropriate translation for this word
            $textToReplace = $this->findReplacementWord($textToReplace);
        }
        // add new line after translation
       // if ($bullets != false) {
        
            //$textToReplace .= "\n";
        //}

        if (strlen($textToReplace) > 0 && $textToReplace != $oldTextToReplace) {
            $this->translatedTermsCounter++;
        }

        // replace current G element with translation DEMO
        $textPosition = strpos($unit, $toReplace);

        $unit = substr_replace($unit, $textToReplace, $textPosition, strlen($toReplace));
        //echo($unit);
        return $unit;
    }


    public function findReplacementWord($textToReplace) {
        // search for this word in english column
        for ($i = 0; $i < count($this->englishTranslation); $i++) {

            if (trim($this->englishTranslation[$i]) == trim($textToReplace)) {

                // increase counter
                $this->foundMatchingTerms++;
                // echo $this->foundMatchingTerms . "<br/>";

                if (strlen($this->currentTranslation[$i]) == " ") {
                   return $textToReplace . "\n";
                } else {

                    $term = $this->currentTranslation[$i];
                    
                    //$term = str_replace('"', "&quot;", $term);
                    //$term = str_replace('&', "&amp;", $term);
                    //$term = str_replace(' <', "&#xD; &lt;", $term);
                    //$term = str_replace('>', "&gt;", $term);
                    //$term = str_replace('<', "&lt;", $term);
                    //break row
                    //$term = str_replace('\\n', "\n", $term);
                    return $term;
                    
                }

            }
        }

        //return "";
        return $textToReplace;
    }


    public function createZipFile() {
        $files = $this->fileNames;
        $zipname = 'translations/translations.zip';
        $zip = new \ZipArchive();
        $zip->open($zipname, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file);
        }
        $zip->close();

        // download zipped file
        $this->downloadFile($zipname);
    }


    public function downloadFile($file) {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

            // if file is downloaded delete all created files from the system
            $this->deleteCreatedFiles($file);
            exit;
        }
    }


    public function deleteCreatedFiles($zipname) {
        // delete zip
        unlink($zipname);

        // loop through files array and delete them too
        foreach ($this->fileNames as $file) {
            unlink($file);
        }
    }

}