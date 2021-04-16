<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function initializeAdmin(){

        $subdivisionController = new SubdivisionController();
        $subdivisionList = $subdivisionController->fetchAllSubdivisions();
        return view('city-view.post-login.admin-files.admin', ['subdivisionList' => $subdivisionList]);
    }

    function checkFeature(Request $request){

        if(isset($request['new-subdivision-name'])){
            echo 'New subdivision feature is enabled-----';
            echo $request['userId'];

            $userId = $request['userId'];
            $subdivisionName = $request['new-subdivision-name'];

            $adminController = new AdminController();
            return $adminController->saveNewSubdivision($subdivisionName, $userId);
        }
    }

    function saveNewSubdivision($subdivisionName, $userId){
        
        $subdivisionController = new SubdivisionController();
        return $subdivisionController->saveSubdivision($subdivisionName, $userId);

        // if ($output == 'success'){

        // }
        // else{
        //     return response()->json([
        //         'statusCode' => '500',
        //         'message' => 'success',
        //         'error' => '',
        //         'comments' => 'Mock Utility Bill added successfully.',
        //         'apartmentId' => $apartmentId
        //     ]);
        // }
    }
}
