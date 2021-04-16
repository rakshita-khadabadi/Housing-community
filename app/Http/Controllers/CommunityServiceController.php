<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityService;

class CommunityServiceController extends Controller
{
    function getAllCommunityServices(){

        return CommunityService::all();
    }
}
