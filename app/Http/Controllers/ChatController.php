<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    function fetchAllChats(){
        return Chat::all();
    }

}
