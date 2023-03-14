<?php
namespace App\Exportable\Objetivos;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ObjetivosReport extends BaseReport {

    public function __construct($data) {
        $this->name_report = "Objetivos subidos";
        $this->sheets = [new ObjetivosSheet($data)];
    }
}

class ObjetivosSheet extends BaseSheet {

    public function __construct($data) {

        $this->view_name = "Excel.exports.objetivos";
        $this->view_data = ["data" => $data];
        $this->row_end = count($data) + 4;
        $this->column_end = "E";
    }

    final public function styles(Worksheet $sheet) {
        $sheet->setAutoFilter("A4:C4");
        parent::styles($sheet); 
    }
}