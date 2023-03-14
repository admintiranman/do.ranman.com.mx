<?php
namespace App\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class BaseSheet implements WithTitle, FromView, WithColumnFormatting, WithStyles {


    protected $title = "";
    protected $view_name = "";
    protected $view_data = [];
    protected $column_format = [];

    protected $column_start = "A";
    protected $column_end =  "A";


    protected $row_end = 1;



    public function title() :string { 
        return $this->title; 
    }


    public function view() :View {
        return view($this->view_name, $this->view_data);
    }

    public function columnFormats() :array {
        return $this->column_format;
    }

    public function styles(Worksheet $sheet) {

        foreach(range($this->column_start, $this->column_end) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet
            ->getStyle("A1:" . $this->column_end . $this->row_end)
            ->getFont()
            ->setName("Calibri Light")                    
            ->setSize(11);            
        $sheet->setSelectedCell("A1");
    }

    
    public function setTitle(string $title) {
        $this->title = $title;
    }
}