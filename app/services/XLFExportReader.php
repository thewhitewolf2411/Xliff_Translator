<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XLFExportReader
{

    private $file;
    private $writer;
    private $spreadsheet;
    private $languages;
    private $fileName;

    public function __construct($file, $languages, $fileName)
    {
        $this->file = $file;
        $this->fileName = $fileName;
        fopen($this->fileName. "_text_to_translate.xlsx", "w");
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->fileName . "_text_to_translate.xlsx");
        $this->spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $this->writer = new Xlsx($this->spreadsheet);
        $this->writer->setPreCalculateFormulas(false);
        $this->languages = $languages;
    }


    public function readFile() {

        $fileText = file_get_contents($this->file);

        // get G tags content
        $this->getTexts($fileText);
    }


    public function getTexts($fileText) {

        // find <g> elements which has text inside opening and closing tag
        $position = 0;
        $idCounter = 1;
        $counter = 2;

        // set column headings
        $this->spreadsheet->getActiveSheet()->setCellValue('A1', "id")->getStyle("A1")->getFont()->setBold(true);
        $this->spreadsheet->getActiveSheet()->setCellValue('B1', "en")->getStyle("B1")->getFont()->setBold(true);
        $excelColumnLetters = range('A', 'Z');

        $coulmnIndex = 2; // because id and en are already set
        $columns = [];
        foreach($this->languages as $lang) {
            $this->spreadsheet->getActiveSheet()->setCellValue($excelColumnLetters[$coulmnIndex] . "1", $this->languages[$coulmnIndex - 2])->getStyle($excelColumnLetters[$coulmnIndex] . "1")->getFont()->setBold(true);
            $this->spreadsheet->getActiveSheet()->getColumnDimension($excelColumnLetters[$coulmnIndex])->setWidth(35);
            $coulmnIndex++;
        }

        $toReplaceData = [];

        while (strpos($fileText, "<g", $position) != false) {

            // current <g position
            $position = strpos($fileText, "<g", $position);

            $currentPosition = $position;

            $position++;

            // find next '>'
            $closingTag = strpos($fileText, ">", $position);

            // check if it is an empty /> element
            if (substr($fileText, ($closingTag - 1), 1) == "/"
                or substr($fileText, ($closingTag + 1), 1) == "<") {
                // continue with next iteration - this is an empty <g> element
                continue;

            } else {

                // find next '</g>' which closes current G element
                $closingTag = strpos($fileText, "</g>", $position) + 4;

                $toReplace = strip_tags(substr($fileText, $currentPosition, ($closingTag - $currentPosition)));

                // replace escaped characters
//                $toReplace = str_replace("&quot;", '"', $toReplace);
//                $toReplace = str_replace("&amp;", '&', $toReplace);
//                $toReplace = str_replace("&#xD;", ' ', $toReplace);
//                $toReplace = str_replace("&gt;", '>', $toReplace);

                $toReplace = trim($toReplace);

                if (!in_array($toReplace, $toReplaceData)) {
                    array_push($toReplaceData, $toReplace);

                    if (strlen($toReplace) > 4 && substr($toReplace, 0, 1) != '&') {
                        $this->spreadsheet->getActiveSheet()->setCellValue('A' . $counter, $counter - 1);
                        $this->spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $counter, $toReplace, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        //$this->spreadsheet->getActiveSheet()->setCellValue('B' . $counter, $toReplace);
                        $this->spreadsheet->getActiveSheet()->getStyle('B' . $counter)->getAlignment()->setWrapText(true);
                        $counter++;
                    }
                }

            }

        }

        // die("EEEE");

        $this->writer->save($this->fileName . "_text_to_translate.xlsx");

        $this->downloadFile($this->fileName . "_text_to_translate.xlsx");
    }


    public function downloadFile($file) {
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
            exit;
        }
    }


    public function deleteCreatedFile($file) {
       unlink($file);
    }
}