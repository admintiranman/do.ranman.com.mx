<?php

namespace App\Exportable\Retroalimentacion;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RetroalimentacionReport extends BaseReport
{

    public function __construct(array $data)
    {

        $this->name_report = "Retroalimentaciones";
        $this->sheets = [
            new RetroTableSheet($data)
        ];
    }
}


class RetroTableSheet extends BaseSheet
{

    public function __construct(array $data)
    {
        $this->view_name = "Excel.exports.retroalimentaciones";
        $this->view_data = [
            'data' => $data
        ];
        $this->row_end = count($data) + 4;
        $this->column_end =  "E";
    }

    final public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter("A4:C4");
        parent::styles($sheet);

        $sheet->getColumnDimension("D")->setAutoSize(false);
        $sheet->getColumnDimension("E")->setAutoSize(false);

        $sheet->getColumnDimension("D")->setWidth(600, "px");
        $sheet->getColumnDimension("E")->setWidth(600, "px");

        $sheet->getStyle("D5:E".$this->row_end)->getAlignment()->setWrapText(true)->setVertical('center');

        $sheet->setSelectedCell("A1");

    }
}
