<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivision;

class SubdivisionController extends Controller
{
    function getSubdivisionById($subdivisionId){

        return Subdivision::find($subdivisionId);
    }

    function addNewSubdivision(Request $request){

        $roleController = new RoleController();
        $adminUserId = $roleController->getAdminUserId();

        $subdivision = new Subdivision();
        $subdivision->subdivision_name = $request->subdivisionName;
        $subdivision->has_manager = 0;              // 0 means no manager
        $subdivision->users_id = $adminUserId;
        
        $subdivision->save();

        return response()->json([
            'statusCode' => '200',
            'message' => 'success',
            'error' => '',
            'comments' => 'New subdivision added successfully',
            'subdivisionId' => $subdivision->id
        ]);
    }
}
