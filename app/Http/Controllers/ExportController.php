<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

// exports class
use App\Exportable\Evaluation\EvaluationReport;
use App\Exportable\Evaluation\EvaluationResult;
use App\Exportable\Organigrama\OrganigramaReport;
use App\Exportable\Retroalimentacion\RetroalimentacionReport;
use App\Exportable\Objetivos\ObjetivosReport;
use App\Exportable\PDI\PDIExport;
use App\Exportable\PDI\PdiExportResult;
// Models
use App\Models\Evaluation;
use App\Models\Retroalimentacion;
use App\Models\Objective;
use App\Models\PlanDesarrolloIndividual;

// Zip
use ZipArchive;
// Storage
use Illuminate\Support\Facades\Storage;


class ExportController extends Controller
{



    public function retroalimentaciones(Request $request)
    {
        $data = Retroalimentacion::
        where('ev_control_id', $request->control_id)
        ->where(function ($query) {
            $query->where('respuesta1', '<>', '')
            ->whereOr('respuesta2', '<>', '');
        })                
        ->orderBy('employee_name', 'asc')
        ->get()
        ->all();
        return Excel::download(new RetroalimentacionReport($data), 'Retroalimentaciones.xlsx');
    }

    public function evaluaciones(Request $request)
    {
        set_time_limit(600);

        $zipFileName = "Evaluaciones.zip";
        $tempFolder = "temp_" . rand();
        $tempFolderEv = "export_result_" .  rand();
        $zipPath = Storage::path($tempFolder . ".zip");
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZIPArchive::CREATE) === true) {
            $data = Evaluation::where('y_potencial', '<>', 0)
            ->where('ev_control_id', $request->control_id)
                ->orderBy('employee_name', 'asc')
                ->get();
            foreach ($data as $d) {
                $file_path_ev = "$tempFolderEv/" . $d->employee_name . ".xlsx";
                Excel::store(new EvaluationResult($d), $file_path_ev);
                $zip->addFile(Storage::path($file_path_ev), "Evaluaciones/" . $d->employee_name . ".xlsx");
            }
            $rand = rand();
            Excel::store(new EvaluationReport($data->all()), "$tempFolderEv/$rand.xlsx");
            $zip->addFile(Storage::path("$tempFolderEv/$rand.xlsx"), "Evaluaciones.xlsx");
            $zip->close();
            Storage::deleteDirectory($tempFolderEv);
            return Storage::download($tempFolder . ".zip", $zipFileName, ["Content-Type: application/octet-stream"]);
        }
        abort(404);
    }


    public function pdi(Request $request)
    {
        set_time_limit(600);
        $zipFileName = "Planes De Desarrollo.zip";
        $tempFolder = "temp_" . rand();
        $zipPath = Storage::path($tempFolder . ".zip");
        $tempFolderExcel = "export_result_" .  rand();        
        $zip = new ZIPArchive();
        if ($zip->open($zipPath, ZIPArchive::CREATE) === true) {
         
            $data = PlanDesarrolloIndividual::where('ev_control_id', $request->control_id)->where('avance', '<>', 0)->orderBy('employee_name', 'asc')->get();

            foreach ($data as $item) {
                $file_path_excel = "$tempFolderExcel/" . $item->employee_name . ".xlsx"; 
                try {
                    Excel::store(new PdiExportResult($item), $file_path_excel);
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($item->nombre);
                }                
                
                $zip->addFile(Storage::path($file_path_excel), "Planes de desarrollo/" .  $item->employee_name . ".xlsx");                
            }
            $file_path_excel = $tempFolderExcel . "/do-planes-desarrollo.xlsx";
            Excel::store(new PDIExport($data), $file_path_excel);
            $zip->addFile(Storage::path($file_path_excel), "DO Planes de desarrollo.xlsx");
            $zip->close();
            Storage::deleteDirectory($tempFolderExcel);
            return Storage::download("$tempFolder.zip", $zipFileName, ["Content-Type: application/octet-stream"]);
        }             
        abort(404);
    }


    public function objetivos(Request $request)
    {
        set_time_limit(600);
        $zipFileName = "objetivos.zip";
        $tempFolder = "temp_" . rand();
        $zipPath = Storage::path($tempFolder . ".zip");        
        $zip = new ZipArchive();
        $tempFolderExcel = "export_result_" .  rand();     

        if ($zip->open($zipPath, ZIPArchive::CREATE) === true) {

            $data = Objective::where('ev_control_id', $request->control_id)
                ->where(function ($query) {
                    $query->whereNotNull('start_path')                
                        ->orWhereNotNull('end_path');
                })                
                ->orderBy('employee_name', 'asc')
                ->get();
            foreach ($data as $d) {
                if ($d->start_path && Storage::exists($d->start_path)) {
                    $zip->addFile(Storage::path($d->start_path), "Objetivos/" . $d->employee_name . "_Inicial.pdf");
                }
                if($d->end_path && Storage::exists($d->end_path)) {
                    $zip->addFile(Storage::path($d->end_path), "Objetivos/" . $d->employee_name . "_Final.pdf");
                }
            }
            $file_path_excel = $tempFolderExcel . "/Reporte Objetivos.xlsx";
            $temp_file = rand();
            Excel::store(new ObjetivosReport($data), $file_path_excel);
            $zip->addFile(Storage::path($file_path_excel), "Reporte Objetivos.xlsx");

            $zip->close();

            Storage::delete($temp_file . ".xlsx");
            
            return Storage::download($tempFolder . ".zip", $zipFileName, ["Content-Type: application/octet-stream"]);
        }
        abort(404);
    }



    // public function report_evaluations()
    // {
    //     $data = Evaluation::where('y_potencial', '<>', 0)->orderBy('employee_name', 'asc')->get()->all();
    //     return Excel::download(new EvaluationReport($data), 'Evaluaciones.xlsx');
    // }


    // public function report_retroalimentaciones()
    // {
    //     $data = Retroalimentacion::where('respuesta1', '<>', '')
    //         ->whereOr('respuesta2', '<>', '')
    //         ->orderBy('employee_name', 'asc')
    //         ->get()
    //         ->all();
    //     return Excel::download(new RetroalimentacionReport($data), 'Retroalimentaciones.xlsx');
    // }



    // public function objetivos_zip()
    // {
    // }


    // public function result($data)
    // {        
    //     return Excel::download(new EvaluationResult($data), "resultado.xlsx");
    // }


    // public function organigrama()
    // {
    //     $data = Profile::with('level', 'user', 'job', 'udn')->get()->all();
    //     return Excel::download(new OrganigramaReport($data), "organigrama.xlsx");
    // }
}
