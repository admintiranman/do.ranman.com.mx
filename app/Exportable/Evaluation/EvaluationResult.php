<?php

namespace App\Exportable\Evaluation;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class EvaluationResult extends BaseReport
{
    public function __construct($data)
    {
        $this->name_report = "Resultados de la evaluación de desempeño y potencial";
        $this->sheets = [
            new EvaluationResultSheet($data)
        ];
    }
}


class EvaluationResultSheet extends BaseSheet
{
    protected $ev = [];



    public function __construct($data)
    {
        $this->view_name = "Excel.exports.evaluacion_resultado";
        $this->view_data = ['ev' => $data];
        $this->row_end = 1000;
        $this->column_end = "F";
        $this->ev = $data;
    }


    final public function styles(Worksheet $sheet)
    {        
        // escribir estilos propiosos

        $index = 7;

        $survey = json_decode($this->ev->survey);        
        foreach($survey as $summary) {
            $index++;
            foreach ($summary->subsummaries as $s) {
                // $sheet->getStyle("D5:E".$this->row_end)->getAlignment()->setWrapText(true)->setVertical('center');                
                $index += count($s->questions);                
                // delete row                
                $sheet->removeRow($index);                            
            }            
            $index++;            
        }

        $sheet->getColumnDimension("A")->setWidth(25, "px");
        $sheet->getColumnDimension("B")->setWidth(150, "px");
        $sheet->getColumnDimension("C")->setWidth(600, "px");
        $sheet->getColumnDimension("D")->setWidth(110, "px");
        $sheet->getColumnDimension("E")->setWidth(110, "px");
        $sheet->getColumnDimension("F")->setWidth(110, "px");
        $sheet->getColumnDimension("G")->setWidth(110, "px");
        $sheet->getColumnDimension("H")->setWidth(350, "px");
        
        $sheet->getStyle("A1:H$index")->getAlignment()->setWrapText(true)->setVertical('center');

        $sheet->setSelectedCell("A1");


        $sheet
            ->getStyle("A7:H" . ($index-2))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle('thin')
            ->setColor(new Color());
    }
}