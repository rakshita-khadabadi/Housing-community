<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function initializeAdmin(){

        return view('city-view.post-login.admin-files.admin');
    }
}
