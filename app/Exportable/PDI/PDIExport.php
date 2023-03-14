<?php
namespace App\Exportable\PDI;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PDIExport extends BaseReport {
    public function __construct($data) {

        $this->name_report = "Reporte de planes de desarrollo";
        $this->sheets = [new PDISheetReport($data)];    
    }
}



class PDISheetReport extends BaseSheet {

    public function __construct($data) {

        $this->view_name = 'Excel.exports.pdi';
        $this->view_data = ['data' => $data];
        $this->column_end = "E";
        $this->row_end = count($data) + 4;
    }

    final public function styles(Worksheet $sheet) {        
        parent::styles($sheet);        
    }
}