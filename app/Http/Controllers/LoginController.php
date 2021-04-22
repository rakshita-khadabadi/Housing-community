<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function showLogin(){

        return view('city-view.login');
    }

    function login(Request $request){

        $email = $request->email;
        $password = md5($request->password);

        $userController = new UserController();
        $output = $userController->loginUser($email, $password);

        $loginUserRecord;

        if($output['message'] == 'success' && $output['userRecord'] != null){
            $loginUserRecord = $output['userRecord'];
            echo json_encode($loginUserRecord);
        }
        elseif($output['userRecord'] == null){
            echo 'The value returned is null';

            $errorMessage = 'email or password does not match. Try Again.';
            return redirect()->back()->with(['error'=> $errorMessage]);
        }
        elseif($output['message'] == 'failed'){
            $errorMessage = $output['error'];
            return redirect()->back()->with(['error'=> $errorMessage]);
        }

        $roleId = $loginUserRecord->roles_id;
        $userId = $loginUserRecord->id;

        $roleController = new RoleController();
        $loginRoleRecord = $roleController->getRoleById($roleId);

        echo json_encode($loginRoleRecord);

        $roleName = $loginRoleRecord->role_name;

        if($roleName == 'admin'){
            return redirect('/admin?userId='.$userId);
        }
        elseif($roleName == 'subdivision manager'){
            return redirect('/subdivision-manager?userId='.$userId);
        }
        elseif($roleName == 'building manager'){

        }
        elseif($roleName == 'apartment owner'){
            return redirect('/apartment-owner?userId='.$userId);

        }
        else{

        }

    }
}
