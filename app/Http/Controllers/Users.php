<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Users extends Controller
{
    //
    public function getUserById($userId){

        // echo "controller userId = $userId";
        return ['userId' => $userId];
    }

    function saveUser(Request $request){
        
        echo nl2br('inside saveUser');
        // echo json_encode($request->input());

        echo 'getting roles';
        $roles = DB::select('select * from roles');
        var_dump($roles);

        return $request->input();
    }
}
