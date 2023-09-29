<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UsersImport;
use App\Models\Departamento;
use App\Models\Job;
use App\Models\Level;
use App\Models\Udn;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->hasRole('Administrador')) {
            $users = User::orderBy('id', 'asc');
            $search = $request->search??'';
            if($search){
                $search = str_replace(' ', '%' , " $search ");
                $users = $users
                        ->where('name',  'like', $search);
            }
            $users = json_encode( $users->with('job', 'udn', 'level', 'boss')->get()->all());
            $search = $request->search??'';    
            return view("users.index", compact('users', 'search'));
        }
        abort(403);    
    }


    public function create(Request $request)
    {         
        if($request->user()->hasRole('Administrador')) {                        
            $participantes = User::where('active', true)
                            ->select('id', DB::raw("concat( [report_id] ,' | ',[name]) as name"))
                            ->get()
                            ->all();
            $jobs = Job::select('name')->get()->all();
            $levels = Level::select('name')->get()->all();
            $udns = Udn::select('name')->get()->all();
            $departamentos = Departamento::select('name')->get()->all();
            return view('users.create', compact('udns', 'levels', 'participantes', 'jobs', 'departamentos'));
        }
        abort(403);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {

            $udn = Udn::firstOrCreate(['name' => $data["udn"]]);
            $level = Level::firstOrCreate(['name' => $data["level"]]);
            $job = Job::firstOrCreate(['name' => $data["job"]]);
            $departamento = Departamento::firstOrCreate(["name" => $data["departamento"]]);

            $report_to = null;
            if($data["jefe_directo"]) {                
                $boss_data = explode(" | ", $data["jefe_directo"]);
                $boss = User::where("report_id", $boss_data[0])->where("name", $boss_data[1])->first();
                $report_to = $boss->report_id;
            }
            $report_id = User::max("report_id");

            $user_data = [
                "name" => $data["name"], 
                "email" => $data["email"], 
                "password" => Hash::make($data["password"]),
                "num_nomina" => $data["num_nomina"], 
                "job_id" => $job->id, 
                "level_id" => $level->id, 
                "udn_id" => $udn->id, 
                "report_to" => $report_to, 
                "departamento_id" => $departamento->id, 
                "report_id" => ($report_id + 1), 
                "talento_clave" => isset($request->talento_clave), 
                "puesto_critico" => isset($request->puesto_critico), 
            ];
            User::create($user_data);
            return redirect()->route('user.index')->with('success', 'Usuario agregado correctamente');

        }
        catch(Exception $ex) {
            return redirect()->route('user.index')->with('error', 'Ocurrio un error al agregar usuario');
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {        
        $tab = $request->query("tab");
        $userAuth = $request->user();
        if(!$tab) {
            $tab = Cookie::get('tab_profile' , 'objetivos');
        }else {
            Cookie::queue('tab_profile', $tab, 360000);
        }

        if($user->id == $userAuth->id || $userAuth->hierarchy($user) || $userAuth->hasRole('Administrador')) {
            return view('users.show', compact('user', 'tab'));
        }
        abort(403);
    }





    public function edit(Request $request, User $user) { 
        if($request->user()->hasRole('Administrador')) {                        
            $participantes = User::where('active', true)
                            ->select('id', DB::raw("concat( [report_id] ,' | ',[name]) as name"))
                            ->get()
                            ->all();
            $jobs = Job::select('name')->get()->all();
            $levels = Level::select('name')->get()->all();
            $udns = Udn::select('name')->get()->all();
            $departamentos = Departamento::select('name')->get()->all();
            return view('users.edit', compact( 'user', 'udns', 'levels', 'participantes', 'jobs', 'departamentos'));
        }
        abort(403);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        try {

            $udn = Udn::firstOrCreate(['name' => $data["udn"]]);
            $level = Level::firstOrCreate(['name' => $data["level"]]);
            $job = Job::firstOrCreate(['name' => $data["job"]]);
            $departament = Departamento::firstOrCreate(["name" => $data["departamento"]??' ']);

            $report_to = null;
            if($data["jefe_directo"]) {                
                $boss_data = explode(" | ", $data["jefe_directo"]);
                $boss = User::where("report_id", $boss_data[0])->where("name", $boss_data[1])->first();
                $report_to = $boss->report_id;
            }
            

            $user_data = [
                "name" => $data["name"], 
                "email" => $data["email"], 
                "num_nomina" => $data["num_nomina"], 
                "job_id" => $job->id, 
                "level_id" => $level->id, 
                "udn_id" => $udn->id, 
                "report_to" => $report_to, 
                "departamento_id" => $departament->id,                
                "talento_clave" => isset($request->talento_clave), 
                "puesto_critico" => isset($request->puesto_critico), 
            ];
            $user->update($user_data);            
            return redirect()->route('user.index')->with('success', 'Usuario agregado correctamente');

        }
        catch(Exception $ex) {
            dd($ex);
            return redirect()->route('user.edit', $user)->with('error', 'Ocurrio un error al agregar usuario');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {        
        $user->report_id = 0;
        $user->report_to = -1;
        $user->save();        
        return redirect()->route('user.index')->with("success", "Usuario eliminado del organigrama");        
    }



    // import / export functions


    public function export() {
        return Excel::download(new UserExport, "colaboradores.xlsx");
    }



    public function import(Request $request) {
        
        $importer = new UsersImport();
        
        try {            
            Excel::import($importer, $request->file("colaboradores"));      
            return redirect()->route('user.index')->with('success', "Actualizacion de plantilla correctamente");
    
        }
        catch(Exception $ex) {             
            Log::error($ex);
            return redirect()->route('user.index')->with("error", "Ocurrio un error al importar la información");
            throw $ex;
        }
    }







}
