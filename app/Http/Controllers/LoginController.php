<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function showLogin(){

        return view('city-view.login');
    }
}
