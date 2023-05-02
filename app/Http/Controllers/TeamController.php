<?php

namespace App\Http\Controllers;

use App\Helpers\Organization as HelpersOrganization;
use App\Models\EvControl;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chart(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first(); 
        }        
        $user = $request->user();
        $user_id = $user->hasRole('Administrador') || $user->hasRole('Director') ? 1 : $user->id;
        $instance = new HelpersOrganization($user_id, $control->id);
        $organigrama = $instance->chart_data();
        return view('admin.organization.organigrama', compact('organigrama'));
    }

    public function index(Request $request)
    {
        $team = $request->user()->team()->select('profiles.*')->join('users as u', 'u.id', 'profiles.user_id')->orderBy('u.name', 'asc')->get();
        return view('team.index', compact('team'));
    }

    public function organigrama(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first(); 
        }

        $options_control = $control ? EvControl::where("id", "<>", $control->id)->get() : [];

        return view('admin.organization.index', [
            'route' => route('organigrama.chart'), 
            'control' => $control, 
            'options_control' => $options_control,
        ]);
    }
}
