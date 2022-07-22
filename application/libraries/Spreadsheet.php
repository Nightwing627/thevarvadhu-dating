<?php
require_once APPPATH."libraries/PhpSpreadsheet/vendor/autoload.php";
class Spreadsheet{

    public  $IOFactory;
    public $CI;
    public function __construct()
    {
        $CI = & get_instance();
    }

    public function identify($inputFileName)
    {
        return \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    }

    public function createReader($inputFileType)
    {
        return \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    }
}














?>