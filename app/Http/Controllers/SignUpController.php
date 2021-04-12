<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\ResponsibleContact;

class SignUpController extends Controller
{
    function signUpNewUser(Request $request){

        echo "Inside signUpNewUser";

        $signUpController = new SignUpController();

        $newUserId = $signUpController->saveUser($request);
        $signUpController->saveUserAddress($request, $newUserId);
        $signUpController->saveUserResponsibleContact($request, $newUserId);

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
    
    function saveUserAddress(Request $request, $newUserId){

        $address = new Address();

        $address->street_address = $request->addressStreet1;
        $address->street_address_line_2 = $request->addressStreet2;
        $address->city = $request->userCity;
        $address->state = $request->userState;
        $address->zip_code = $request->userZipCode;
        $address->country = $request->userCountry;
        $address->users_id = $newUserId;

        $address->save();

    }

    function saveUserResponsibleContact(Request $request, $newUserId){

        $responsibleContact = new ResponsibleContact();

        $responsibleContact->name = $request->rcName;
        $responsibleContact->address = $request->rcAddress;
        $responsibleContact->city = $request->rcCity;
        $responsibleContact->zip_code = $request->rcZipCode;
        $responsibleContact->country = $request->rcCountry;
        $responsibleContact->phone_number = $request->rcPhoneNumber;
        $responsibleContact->users_id = $newUserId;

        $responsibleContact->save();

    }
}
