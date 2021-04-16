<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\ResponsibleContact;
use App\Models\Role;
use App\Models\Subdivision;
use App\Models\ApartmentUtilityServiceProviderType;
use Exception;
use Illuminate\Support\Str;

class SignUpController extends Controller
{   

    function initializeSignUp(){

        $roleController = new RoleController();
        $rolesList = $roleController->getSignUpRoles();

        $apartmentController = new ApartmentController();
        $apartmentsList = $apartmentController->fetchAllEmptyApartments();

        $buildingController = new BuildingController();
        $buildingsList = $buildingController->fetchAllBuildings();

        $subdivisionController = new SubdivisionController();
        $subdivisionsList = $subdivisionController->fetchAllSubdivisions();

        return view('city-view.sign-up', [
            'rolesList' => $rolesList,
            'apartmentsList' => $apartmentsList,
            'buildingsList' => $buildingsList,
            'subdivisionsList' => $subdivisionsList
            ]);
    }

    function signUpNewUser(Request $request){

        $signUpController = new SignUpController();

        $roleName = $request->roleName;

        $roleController = new RoleController();
        $roleRecord = $roleController->getRoleByName($roleName);
        echo json_encode($roleRecord);
        $roleId = $roleRecord->id;

        $newUserId;
        $output = $signUpController->saveUser($request, $roleId);

        if($output['message'] == 'success'){
            if ($output['message'] == 'success'){
                echo 'received new userId';
                $newUserId = $output['newUserId'];
            }
        }
        elseif ($output['message'] == 'failed'){
            echo 'User has not been saved.';
            echo $output['error'];
            return redirect()->back()->with(['error'=> $output['error']]);
        }
        
        

        // $roleId = $roleRecord->role_name;

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
            $errorMessage = 'This scenario should not occur. Role out of scope. Check DB';
            return redirect()->back()->with(['error'=> $errorMessage]);
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
            $serviceProviderTypeRecord->utility_name = $utilityRecord->utility_name;

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

            $successMessage = 'Successfully added as Apartment Owner. Please Login.';

            return redirect('/login')->with([
                'success'=> $successMessage, 
                'newUserEmail' => $request->email,
                'newUserPassword' => $request->password
                ]);

        }
        elseif($apartmentRecord->occupancy_status == 'occupied'){

            $userController = new UserController();
            $userController->deleteUser($newUserId);

            $errorMessage = 'This Apartment is occupied. Choose another apartment.';
            return redirect()->back()->with(['error'=> $errorMessage]);
        }
        else{
            
            $errorMessage = 'This scenario should not occur. occupancy_status is not empty or occupied. Check DB';
            return redirect()->back()->with(['error'=> $errorMessage]);
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

            $successMessage = 'Successfully added as Building Manager. Please Login.';

            return redirect('/login')->with([
                'success'=> $successMessage, 
                'newUserEmail' => $request->email,
                'newUserPassword' => $request->password
                ]);
        }
        elseif($buildingRecord->has_manager == 1){

            $userController = new UserController();
            $userController->deleteUser($newUserId);
            
            $errorMessage = 'This Building already has a manager. Choose another building.';
            return redirect()->back()->with(['error'=> $errorMessage]);
            
        }
        else{
            
            $errorMessage = 'This scenario should not occur. has_manager is not 0 or 1. Check DB';
            return redirect()->back()->with(['error'=> $errorMessage]);
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

            $successMessage = 'Successfully added as Subdivision Manager. Please Login.';

            return redirect('/login')->with([
                'success'=> $successMessage, 
                'newUserEmail' => $request->email,
                'newUserPassword' => $request->password
                ]);
        }
        elseif($subdivisionRecord->has_manager == 1){

            $userController = new UserController();
            $userController->deleteUser($newUserId);

            $errorMessage = 'This Subdivision already has a manager. Choose another subdivision.';
            return redirect()->back()->with(['error'=> $errorMessage]);
        }
        else{           

            $errorMessage = 'This scenario should not occur. has_manager is not 0 or 1. Check DB';
            return redirect()->back()->with(['error'=> $errorMessage]);
        }

    }

    function saveUser(Request $request, $roleId){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        // $date = new DateTime("now", new DateTimeZone('America/Chicago') );
        // $current_date_time = $date->format('Y-m-d H:i:s');

        $user = new User();

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email_id = $request->email;
        $user->password = md5($request->password);
        $user->area_code = $request->userZipCode;
        $user->phone_number = $request->userPhoneNumber;
        $user->joining_datetime = $current_date_time;
        // $user->roles_id = $request->roleId;
        $user->roles_id = $roleId;

        // This try catch is to catch duplicate email id 
        try{
            $output = $user->save();
            return [
                'message' => 'success',
                'newUserId' => $user->id
            ];
            // return $user->id;
        }
        catch(Exception $e){

            $errorMessage = '';
            $duplicateError = Str::contains($e->getMessage(), 'Integrity constraint violation: 1062 Duplicate entry');
            $emailDuplicateError = Str::contains($e->getMessage(), "for key 'users.email_id_UNIQUE'");

            if($duplicateError && $emailDuplicateError){
                $errorMessage = 'email '.$request->email.' already exists. Choose another email.';
            }
            else{
                $errorMessage = $e->getMessage();
            }

            return [
                'message' => 'failed',
                'error' => $errorMessage
            ];
            
        }
        
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
