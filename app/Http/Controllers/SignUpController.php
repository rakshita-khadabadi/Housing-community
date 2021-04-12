<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\ResponsibleContact;
use App\Models\Role;
use App\Models\Subdivision;
use App\Models\ApartmentUtilityServiceProviderType;

class SignUpController extends Controller
{
    function signUpNewUser(Request $request){

        $signUpController = new SignUpController();

        $newUserId = $signUpController->saveUser($request);
        
        $roleId = $request->roleId;

        $roleController = new RoleController();
        $roleRecord = $roleController->getRoleById($roleId);

        return $signUpController->saveAsPerRole($roleRecord, $request, $newUserId, $signUpController);
    }


    function addAddressAndRC($request, $newUserId, $signUpController){
        $signUpController->saveUserAddress($request, $newUserId);
        $signUpController->saveUserResponsibleContact($request, $newUserId);
    }


    function saveAsPerRole($roleRecord, $request, $newUserId, $signUpController){

        if($roleRecord->role_name == 'subdivision manager'){
            return $signUpController->saveSubdivisionManager($request, $newUserId, $signUpController);
        }
        elseif($roleRecord->role_name == 'building manager'){
            return $signUpController->saveBuildingManager($request, $newUserId, $signUpController);
        }
        elseif($roleRecord->role_name == 'apartment owner'){
            return $signUpController->saveApartmentOwner($request, $newUserId, $signUpController);
        }
        else{
            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'Role out of scope',
                'comments' => 'Role out of scope'
            ]); 
        }

    }

    function saveServiceProviderType($request, $apartmentId, $buildingId, $subdivisionId, $userId){

        $utilityController = new UtilityController();
        $utilityList = $utilityController->getAllUtilities();

        foreach ($utilityList as $utilityRecord){
            
            $serviceProviderTypeRecord = new ApartmentUtilityServiceProviderType();

            if ($utilityRecord->utility_name == 'electricity'){
                $serviceProviderTypeRecord->service_provider_type = $request->electricityServiceProvider;
            }
            elseif ($utilityRecord->utility_name == 'gas'){
                $serviceProviderTypeRecord->service_provider_type = $request->gasServiceProvider;
            }
            elseif ($utilityRecord->utility_name == 'water'){
                $serviceProviderTypeRecord->service_provider_type = $request->waterServiceProvider;
            }
            elseif ($utilityRecord->utility_name == 'internet'){
                $serviceProviderTypeRecord->service_provider_type = $request->internetServiceProvider;
            }

            $serviceProviderTypeRecord->utilities_id = $utilityRecord->id;
            $serviceProviderTypeRecord->apartments_id = $apartmentId;
            $serviceProviderTypeRecord->buildings_id = $buildingId;
            $serviceProviderTypeRecord->subdivisions_id = $subdivisionId;
            $serviceProviderTypeRecord->users_id = $userId;

            $serviceProviderTypeRecord->save();

        }

    }


    function saveApartmentOwner($request, $newUserId, $signUpController){

        $apartmentController = new ApartmentController();
        $apartmentId = $request->apartmentId;

        $apartmentRecord = $apartmentController->getApartmentById($apartmentId);

        if($apartmentRecord->occupancy_status == 'empty'){

            $apartmentRecord->occupancy_status = 'occupied';
            $apartmentRecord->users_id = $newUserId;
            $apartmentRecord->save();

            $apartmentId = $apartmentRecord->id;
            $buildingId = $apartmentRecord->buildings_id;
            $subdivisionId = $apartmentRecord->subdivisions_id;
            $userId = $apartmentRecord->users_id;

            $signUpController->saveServiceProviderType($request, $apartmentId, $buildingId, $subdivisionId, $userId);
            $signUpController->addAddressAndRC($request, $newUserId, $signUpController);

            return response()->json([
                'statusCode' => '200',
                'message' => 'success',
                'error' => '',
                'comments' => 'New user saved successfully. You are apartment owner now.',
                'userId' => $apartmentId
            ]);

        }
        elseif($apartmentRecord->occupancy_status == 'occupied'){

            $userController = new UserController();
            $userController->deleteUser($newUserId);

            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'This Apartment already has an owner. Choose another apartment.',
                'comments' => 'This Apartment already has an owner. Choose another apartment.'
            ]); 
        }
        else{
            return response()->json([
                'statusCode' => '200',
                'message' => 'failed',
                'error' => 'occupancy_status is not empty or occupied. Check DB',
                'comments' => 'occupancy_status is not empty or occupied. Check DB'
            ]); 
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
