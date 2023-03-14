<?php

namespace App\Exportable\Evaluation;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class  EvaluationReport extends BaseReport {
    
    
    public function __construct(array $data) {
        $this->name_report = "Reporte de Evaluaciones";
        $this->sheets = [
            new EvaluationTableSheet($data)
        ];
    }
}


class EvaluationTableSheet extends BaseSheet  { 

    public function __construct($data) {     
        $this->view_name = "Excel.exports.evaluaciones";
        $this->view_data = [
            'data' => $data,
        ];
        $this->row_end = count($data) + 3;
        $this->column_end = "H";
    }


    final public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter("A3:E3");
        parent::styles($sheet);
    }
}