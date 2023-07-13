<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Organization as HelpersOrganization;
use App\Models\Job;
use App\Models\User;
use App\Models\EvControl;

class AdminController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        // middleware admin
    }

    public function jobs()
    {
        $jobs = Job::orderBy('name', 'asc');
        return view('admin.jobs', compact('jobs'));
    }

    public function organigrama_chart(Request $request, $grupo)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first(); 
        }        
        

        if ($request->user()->hasRole('Administrador')) {

            $user_id = -1;
            switch ($grupo) {
                case 'GV':
                    $user_id = User::where('name', 'like' , 'Vicente%Rangel%')->orderBy("id", "asc")->first()->id;
                    break;
                case 'FN':
                    $user_id = User::where('name', 'like' , 'Alberto%Rangel%')->orderBy("id", "asc")->first()->id;
                    break;
                case 'VEXA-XCALAK':
                    $user_id = User::where('name', 'like' , '%Cecilia%Rangel%')->orderBy("id", "asc")->first()->id;                    
                    break;
                // case 'XCALAK':
                //     $user_id = User::where('name', 'like' , 'Vicente%Rangel%')->latest()->first()->id; // Rodolfo oropeza
                //     break;
            }
            $instance = new HelpersOrganization($user_id, $control->id);
            $organigrama = $instance->chart_data();

            // dd($organigrama);



            return view('admin.organization.organigrama', compact('organigrama'));
        }
        abort(403);
    }


    public function organigrama(Request $request, $grupo)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first(); 
        }

        $options_control = $control ? EvControl::where("id", "<>", $control->id)->get() : [];

        return view('admin.organization.index', [
            'route' => (route('admin.organigrama_chart', $grupo)  . "?control=" . $control->id), 
            // 'route' => route('organigrama.chart')  . "?control=" . $control->id, 
            'control' => $control, 
            'options_control' => $options_control
        ]);
    }
}
