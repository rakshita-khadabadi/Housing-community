<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;

class BuildingController extends Controller
{
    function getBuildingById($buildingId){

        return Building::find($buildingId);
    }

    function addNewBuilding(Request $request){

        $roleController = new RoleController();
        $adminUserId = $roleController->getAdminUserId();

        $building = new Building();
        $building->building_name = $request->buildingName;
        $building->occupancy_status = 'empty';
        $building->has_manager = 0;              // 0 means no manager
        $building->subdivisions_id = $request->subdivisionId;
        $building->users_id = $adminUserId;
        
        $building->save();

        $buildingId = $building->id;
        
        $apartmentController = new ApartmentController();
        $apartmentController->addApartmentsToBuilding($request, $buildingId, $adminUserId);

        return response()->json([
            'statusCode' => '200',
            'message' => 'success',
            'error' => '',
            'comments' => 'New building added successfully',
            'buildingId' => $buildingId
        ]);
    }
}
