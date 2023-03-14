<?php
namespace App\Exportable;

use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;




class BaseReport implements WithProperties, WithMultipleSheets {

    use Exportable;


    public function __construct() { }

    public function properties() :array {
        return [
            'creator' => 'TI',
            'lastModifiedBy' => 'TI',
            'title' => $this->name_report,
            'description' => $this->name_report,
            'subject' => $this->name_report,
            'keywords' => 'Reportes NAV',
            'category' => 'Reportes NAV',
            'manager' => 'Angel Zarate',
            'company' => 'Valoran',
        ];
    }

    public function sheets() :array {
        return $this->sheets;
    }
    
}