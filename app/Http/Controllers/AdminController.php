<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function initializeAdmin(){

        $subdivisionController = new SubdivisionController();
        $subdivisionList = $subdivisionController->fetchAllSubdivisions();

        $itRequestController = new ItRequestController();
        $itrList = $itRequestController->fetchAllItRequests();

        $adminController = new AdminController();

        $subdivisionManagerRecordList = $adminController->getAllSubdivisionManagerList();
        // echo $subdivisionManagerRecordList;
        $buildingManagerRecordList = $adminController->getAllBuildingManagerList();
        // echo $buildingManagerRecordList;
        $apartmentOwnerRecordList = $adminController->getAllApartmentOwnerList();
        // echo $apartmentOwnerRecordList;

        return view('city-view.post-login.admin-files.admin', [
            'subdivisionList' => $subdivisionList,
            'itrList' => $itrList,
            'subdivisionManagerRecordList' => $subdivisionManagerRecordList,
            'buildingManagerRecordList' => $buildingManagerRecordList,
            'apartmentOwnerRecordList' => $apartmentOwnerRecordList
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

    function getAllSubdivisionManagerList(){

        return DB::table('users as u')
            ->join('subdivisions AS s','s.users_id','=','u.id')
            ->where('s.has_manager','=',1)
            ->get();
    }

    function getAllBuildingManagerList(){

        return DB::table('users as u')
            ->join('buildings AS b','b.users_id','=','u.id')
            ->where('b.has_manager','=',1)
            ->get();
    }

    function getAllApartmentOwnerList(){
        
        return DB::table('users as u')
            ->join('apartments AS a','a.users_id','=','u.id')
            ->join('buildings AS b','b.id','=','a.buildings_id')
            ->where('a.occupancy_status','=','occupied')
            ->get();
    }

}
