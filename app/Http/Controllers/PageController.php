<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    // home page
    public function home(){
        $employee = auth()->user();
        return view('home',compact('employee'));
    }
}
