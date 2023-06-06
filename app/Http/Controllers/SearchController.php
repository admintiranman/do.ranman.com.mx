<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Survey;

class SearchController extends Controller
{
    public function search(Request $request) {


        $response = [];
        $text = $request->search;
        $users = User::where('users.name', 'like', "%$text%")->selectRaw("users.name, concat('/user/', users.id) as url")->orderBy('users.name', 'asc')->get()->all();        
        $puestos = Job::where('name', 'like', "%$text%")->selectRaw("jobs.name, concat('/admin/jobs/', id, '/edit') as url")->orderBy('name', 'asc')->get()->all();
        $encuestas = Survey::where('name', 'like', "%$text%")->selectRaw("name, concat('/survey/', slug) as url")->orderBy('name', 'asc')->get()->all();

        if(count($users) > 0) {
            $response[] = [
                'type' => 'Colaboradores', 
                'items'  => $users, 
            ];
        }


        if(count($puestos) > 0) {
            $response[] = [
                'type' => 'Puestos', 
                'items' => $puestos
            ];
        }
        
        if(count($encuestas) > 0) { 
            $response[] = [
                'type' => 'Encuestas', 
                'items' => $encuestas
            ];
        }

        // documentacion Fija
        $response[] = [
            'type' => 'Manuales y Documentación',
            'items' => [
                [
                    'name' => '¿Qué SÍ hacer y que NO hacer al co-crear un Plan de Desarrollo Individual con mi colaborador?', 
                    'url' => '/documentation/competencias'
                ], 
                [
                    'name' => 'Manual de Desarrollo de Competencias y Conocimientos', 
                    'url' => '/documentation/competencias'
                ]
            ]
        ];
        return response()->json($response);
    } 
    //
}
