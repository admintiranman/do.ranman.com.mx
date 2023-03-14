<?php

namespace App\Exportable\Organigrama;

use App\Exportable\BaseReport;
use App\Exportable\BaseSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrganigramaReport extends BaseReport
{


    public function __construct(array $data)
    {

        $this->name_report = "Organigrama Valoran";
        $this->sheets = [
            new OrganigramaExportSheet($data)
        ];
    }
}


class OrganigramaExportSheet extends BaseSheet
{

    public function __construct(array $data)
    {

        $this->view_name = "Excel.exports.organigrama";
        $this->view_data = [
            'data' => $data
        ];
        $this->column_end = 'J';
        $this->row_end = count($data) + 1;
    }

    final public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter("A1:H1");
        parent::styles($sheet);
    }
}
