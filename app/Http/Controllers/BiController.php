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
        $link = config('app.link_bi');    
        return view('bi.9box', compact('link'));
    }
    //
}
