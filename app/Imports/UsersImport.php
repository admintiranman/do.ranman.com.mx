<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\Level;
use App\Models\Udn;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{

    protected $data = [];

    public function get_date() {
        return $this->data;
    }


    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {

        foreach($rows as $row) {       

            if ($row["estatus"] == "Baja") {
                $user = User::where("name", $row["nombre"])->orWhere("report_id", $row["report_id"])->first();
                if($user) { 
                    $user->report_id = 0;
                    $user->report_to = -1;
                    $user->save();
                }
                    

            }else if ($row["estatus"] == "Alta" || $row["estatus"] == "Activo") {
                
                
                $job = Job::firstOrcreate(["name" => $row["puesto"]]);
                $level = Level::firstOrcreate(["name" => $row["nivel"]]);
                $udn = Udn::firstOrcreate(["name" => $row["udn"]]);

                $report_to = null;
                if($row["jefe_directo"]) {                                    
                    $boss = User::where("name", $row["jefe_directo"])->first();
                    $report_to = $boss->report_id;
                }

                $data = [
                    "name" => $row["nombre"], 
                    "email" => $row["email"], 
                    "num_nomina" => $row["num_nomina"], 
                    "job_id" => $job->id,
                    "level_id" => $level->id,
                    "udn_id" => $udn->id,
                    "report_to" => $report_to, 
                    "departamento_id" => $row["departamento"],
                    "puesto_critico" => $row["puesto_critico"]??false, 
                    "talento_clave" => $row["talento_clave"]??false,
                
                ];

                if($row["estatus"] == "Activo") {
                    $user = User::where('report_id', $row["report_id"]);
                    if($user) { 
                        $user->update($data);
                    }
                }
                else if($row["estatus"] == "Alta|") {

                    $report_id = User::max("report_id");
                    $data["report_id"] = ($report_id + 1); 
                    $user = User::create($data);
                }
            }    
        }
    }
}
