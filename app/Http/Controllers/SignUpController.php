<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\ResponsibleContact;
use App\Models\Role;
use App\Models\Subdivision;

class SignUpController extends Controller
{
    function signUpNewUser(Request $request){

        // echo "Inside signUpNewUser";

        $signUpController = new SignUpController();

        $newUserId = $signUpController->saveUser($request);
        

        $roleId = $request->roleId;

        $roleController = new RoleController();


        $roleRecord = $roleController->getRoleById($roleId);

        // echo $roleRecord;

        return $signUpController->saveAsPerRole($roleRecord, $request, $newUserId, $signUpController);

        // return response()->json([
        //     'statusCode' => '200',
        //     'message' => 'success',
        //     'error' => '',
        //     'comments' => 'New user saved successfully',
        //     'userId' => $newUserId
        // ]);
    }

    function addAddressAndRC($request, $newUserId, $signUpController){
        $signUpController->saveUserAddress($request, $newUserId);
        $signUpController->saveUserResponsibleContact($request, $newUserId);
    }

    function saveAsPerRole($roleRecord, $request, $newUserId, $signUpController){

        if($roleRecord->role_name == 'subdivision manager'){
            // echo 'You want subdivision manager';
            return $signUpController->saveSubdivisionManager($request, $newUserId, $signUpController);
        }
        elseif($roleRecord->role_name == 'building manager'){
            return $signUpController->saveBuildingManager($request, $newUserId, $signUpController);
        }
        elseif($roleRecord->role_name == 'apartment owner'){

        }

    }

    function saveBuildingManager($request, $newUserId, $signUpController){
        
        $buildingController = new BuildingController();
        $buildingId = $request->buildingId;

        $buildingRecord = $buildingController->getBuildingById($buildingId);

        if($buildingRecord->has_manager == 0){
            $buildingRecord->has_manager = 1;
            $buildingRecord->users_id = $newUserId;
            $buildingRecord->save();

            $signUpController->addAddressAndRC($request, $newUserId, $signUpController);

            return response()->json([
                'statusCode' => '200',
                'message' => 'success',
                'error' => '',
                'comments' => 'New user saved successfully. You are building manager now.',
                'userId' => $newUserId
            ]);
        }
        elseif($buildingRecord->has_manager == 1){

            $userController = new UserController();
            $userController->deleteUser($newUserId);

            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'This Building already has a manager. Choose another building.',
                'comments' => 'This Building already has a manager. Choose another building.'
            ]); 
        }
        else{
            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'has_manager is not 0 or 1. Check DB',
                'comments' => 'has_manager is not 0 or 1'
            ]); 
        }
    }

    function saveSubdivisionManager($request, $newUserId, $signUpController){

        $subdivisionController = new SubdivisionController();
        $subdivisionId = $request->subdivisionId;
        
        $subdivisionRecord = $subdivisionController->getSubdivisionById($subdivisionId);

        // echo $subdivisionRecord;

        if($subdivisionRecord->has_manager == 0){
            
            $subdivisionRecord->has_manager = 1;
            $subdivisionRecord->users_id = $newUserId;
            $subdivisionRecord->save();

            $signUpController->addAddressAndRC($request, $newUserId, $signUpController);

            return response()->json([
                'statusCode' => '200',
                'message' => 'success',
                'error' => '',
                'comments' => 'New user saved successfully. You are subdivision manager now.',
                'userId' => $newUserId
            ]);
        }
        elseif($subdivisionRecord->has_manager == 1){

            $userController = new UserController();
            $userController->deleteUser($newUserId);

            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'This Subdivision already has a manager. Choose another subdivision.',
                'comments' => 'This Subdivision already has a manager. Choose another subdivision.'
            ]); 
        }
        else{
            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'has_manager is not 0 or 1. Check DB',
                'comments' => 'has_manager is not 0 or 1'
            ]); 
        }

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
