<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Organization;

class BiController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function nine_box(Request $request) {                    
        
        if($request->user()->hasRole('9box')) {
            $link = ($request->item??'current') == 'current' ? config('app.link_bi') : config('app.link_bi_old');    
            $rep = $request->item??'current';
            return view('bi.9box', compact('link', 'rep'));

        }

        abort(401);

        
        

        
    }
    //
}
