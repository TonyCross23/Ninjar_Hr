<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProfileController extends Controller
{
    //profile
    public function index () {
        $employee = auth()->user();

        return view('profile.profile',compact('employee'));
    }


}
