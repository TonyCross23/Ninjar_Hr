<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // home page
    public function home(){
        $employee = auth()->user();
        return view('home',compact('employee'));
    }
}
