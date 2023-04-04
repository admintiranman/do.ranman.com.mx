<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromView, ShouldAutoSize
{
    
    public function view(): View
    {
        $users = User::orderBy('id', 'asc')->get();
        return view("export.users", compact('users'));
    }






}
