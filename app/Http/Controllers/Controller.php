<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function arrary_to_matriz($data, $size = 3 ) {
        
        $result = [];
        $aux = [];
        $index = 0;
        foreach ($data as $d) {
            if($index % $size == 0) {
                $aux = []; 
            }
            $index++;
            $aux[] = $d;
            if($index % $size == 0) {
                $result[] = $aux;
            }
        }
        if ($index % 3 != 0) { 
            $result[] = $aux;
        }
        return $result;
    }

}
