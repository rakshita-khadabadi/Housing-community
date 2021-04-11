<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    function getUser(){

        return User::get();
    }

    function saveUser(Request $request){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $user = new User();

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email_id = $request->email;
        $user->password = $request->password;
        $user->area_code = $request->areaCode;
        $user->phone_number = $request->phoneNumber;
        $user->joining_datetime = $current_date_time;
        $user->roles_role_id = $request->rolesRoleId;

        $user->save();

        var_dump($user);
        return 'User saved';
    }
}