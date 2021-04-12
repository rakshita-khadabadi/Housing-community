<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    
    function getUserById($user_id){

        // echo "Inside getUserById";
        // return User::find($user_id)->getRole();
        return User::find($user_id);
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
        $user->roles_id = $request->rolesId;

        $output = $user->save();

        return response()->json([
            'statusCode' => '200',
            'message' => 'success',
            'error' => '',
            'comments' => 'New user saved successfully',
            'userId' => $user->id
        ]);
    }
}