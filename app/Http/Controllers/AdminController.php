<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function initializeAdmin(){

        $subdivisionController = new SubdivisionController();
        $subdivisionList = $subdivisionController->fetchAllSubdivisions();

        $itRequestController = new ItRequestController();
        $itrList = $itRequestController->fetchAllItRequests();

        return view('city-view.post-login.admin-files.admin', [
            'subdivisionList' => $subdivisionList,
            'itrList' => $itrList
            ]);
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
            echo 'Inside feature check of new building name.';
            $userId = $request['userId'];
            $buildingName = $request['new-building-name'];
            $subdivisionId = $request['subdivision-name'];
            echo '=======';
            echo $subdivisionId;
            echo '=======';

            $adminController = new AdminController();
            return $adminController->saveNewBuilding($request, $buildingName, $subdivisionId, $userId);
        }

    }

    function saveNewBuilding($request, $buildingName, $subdivisionId, $userId){
        echo 'Inside saveNewBuilding';
        $buildingController = new BuildingController();
        return $buildingController->addNewBuilding($request, $buildingName, $subdivisionId, $userId);
    }

    function saveNewSubdivision($subdivisionName, $userId){
        
        $subdivisionController = new SubdivisionController();
        return $subdivisionController->saveSubdivision($subdivisionName, $userId);
    }
}
