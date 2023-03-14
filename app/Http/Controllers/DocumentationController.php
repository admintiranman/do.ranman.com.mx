<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{

    public function index() {
        $data = [
            (object) [
                "filename" => "¿Qué SÍ hacer y que NO hacer al co-crear un Plan de Desarrollo Individual con mi colaborador?", 
                "path" => route("documentation.pdi"), 
            ], 
            (object) [
                "filename" => "Manual de Desarrollo de Competencias y Conocimientos", 
                "path" => route("documentation.competencias"),
            ], 
            (object) [
                "filename" => "Interpretación de Organigrama", 
                "path" => route("documentation.interpretacion")
            ], 
            (object) [
                "filename" => "Formato para retroalimentar", 
                "path" => route("documentation.retroalimentacion"),
                
            ], 
            (object) [
                "filename" => "Preguntas poderosas de coaching", 
                "path" => route("documentation.coaching")
            ],             
        ];
        return view('documentation.index', compact('data'));
    }


    public function coaching() {

        $filename = "Preguntas-poderosas-de-coaching.pdf";
        return Storage::download("documentation/$filename", $filename, ["Content-Disposition" => "inline;"]);
    }


    public function retroalimentacion() {
        $filename = "Formato-para-retroalimentar.pdf";
        return Storage::download("documentation/$filename", $filename, ["Content-Disposition" => "inline;"]);
    }


    public function pdi() 
    {
        $filename = "Qué sí hacer y que no hacer.pdf";
        return Storage::download("documentation/$filename", $filename, ["Content-Disposition" => "inline;"]);
    }

    public function competencias() 
    {
        $filename = "MANUAL_COMPETENCIAS GV.pdf";
        return Storage::download("documentation/$filename", $filename, ["Content-Disposition" => "inline;"]);
    }

    public function interpretacion() {
        $filename  = "Interpretación de Organigrama.pdf";
        return Storage::download("documentation/$filename", $filename, ["Content-Disposition" => "inline;"]);
    }
    
}
