<?php
namespace App\Exportable\PDI;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PdiExportResult extends BaseReport {

    public function __construct($data) {
        $this->name_report = "Plan de desarrollo individual";
        $this->sheets = [new PdiResultSheet($data)];

    }
}


class PdiResultSheet extends BaseSheet {

    public function __construct($data) {
        $this->view_name = "Excel.exports.pdi_show";
        $this->view_data = ['data' => $data];
        $row_end =  5;
        foreach(json_decode($data->body) as $item) {
            $row_end += max(count($item->detalles->practica),  count($item->detalles->guia), count($item->detalles->formacion));
        }
        $this->row_end = $row_end;
        $this->column_end = "M";
    }


    final public function styles(Worksheet $sheet) {
        $sheet->setShowGridlines(false);

        $sheet->getColumnDimension("A")->setWidth(25, "px");
        $sheet->getColumnDimension("B")->setWidth(300, "px");
        $sheet->getColumnDimension("C")->setWidth(135, "px");
        $sheet->getColumnDimension("D")->setWidth(135, "px");
        $sheet->getColumnDimension("E")->setWidth(135, "px");
        $sheet->getColumnDimension("F")->setWidth(135, "px");
        $sheet->getColumnDimension("G")->setWidth(135, "px");
        $sheet->getColumnDimension("H")->setWidth(135, "px");
        $sheet->getColumnDimension("I")->setWidth(135, "px");
        $sheet->getColumnDimension("J")->setWidth(135, "px");
        $sheet->getColumnDimension("K")->setWidth(135, "px");
        $sheet->getColumnDimension("L")->setWidth(135, "px");
        $sheet->getColumnDimension("M")->setWidth(135, "px");

        // $sheet->getStyle("D5:E".$this->row_end)->getAlignment()->setWrapText(true)->setVertical('center')


        $sheet->getRowDimension(2)->setRowHeight(35, "px");
        $sheet->getRowDimension(3)->setRowHeight(35, "px");
        $sheet->getRowDimension(4)->setRowHeight(35, "px");
        $sheet->getRowDimension(5)->setRowHeight(40, "px");


        $row_end = $this->row_end; //
        $sheet->getStyle("B2:M". $row_end)->getAlignment()->setWrapText(true)->setVertical('center');




        $sheet
            ->getStyle("B2:M" . $row_end)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle('thin')
            ->setColor(new Color());


            $sheet
                ->getStyle("B" . ($row_end +3) . ":M" . ($row_end + 7))
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle('thin')
                ->setColor(new Color());

        $sheet->setSelectedCell("B2");

    }
}