<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdivisionManagerController extends Controller
{
    function initializeSubdivisionManager(Request $request){

        $userId = $request['userId'];

        $userController = new UserController();
        $personalDetails = $userController->getUserById($userId);
        // echo $personalDetails;

        return view('city-view.post-login.subdivision.subdivision-manager', ['personalDetails' => $personalDetails]);
    }

    function checkFeature(){
        echo 'Inside checkFeature';
    }

}
