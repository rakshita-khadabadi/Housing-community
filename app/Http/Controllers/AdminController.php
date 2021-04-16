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
        elseif(isset($request['new-building-name'])){
            $userId = $request['userId'];
            $buildingName = $request['new-building-name'];

            $adminController = new AdminController();
        }

    }

    function saveNewBuilding($buildingName, $userId){
        
    }

    function saveNewSubdivision($subdivisionName, $userId){
        
        $subdivisionController = new SubdivisionController();
        return $subdivisionController->saveSubdivision($subdivisionName, $userId);
    }
}
