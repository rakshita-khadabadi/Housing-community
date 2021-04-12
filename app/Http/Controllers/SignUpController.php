<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignUpController extends Controller
{
    function signUpNewUser(Request $request){

        echo "Inside signUpNewUser";

        $signUpController = new SignUpController();

        $newUserId = $signUpController->saveUser($request);

        return response()->json([
            'statusCode' => '200',
            'message' => 'success',
            'error' => '',
            'comments' => 'New user saved successfully',
            'userId' => $newUserId
        ]);
    }

    function saveUser(Request $request){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $user = new User();

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email_id = $request->email;
        $user->password = $request->password;
        $user->area_code = $request->userZipCode;
        $user->phone_number = $request->userPhoneNumber;
        $user->joining_datetime = $current_date_time;
        $user->roles_id = $request->roleId;

        $output = $user->save();

        return $user->id;
    } 
}
