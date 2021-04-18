<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubdivisionController extends Controller
{
    function fetchAllSubdivisions(){

        return Subdivision::all();
    }

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

    function saveSubdivision($subdivisionName, $userId){

        $subdivision = new Subdivision();
        $subdivision->subdivision_name = $subdivisionName;
        $subdivision->has_manager = 0;      // 0 represents no manager assigned
        $subdivision->users_id = $userId;

        try{
            $subdivision->save();

            $successMessage = 'Successfully added Subdivision '.$subdivisionName;
            return redirect()->back()->with(['success'=> $successMessage]);
        }
        catch(Exception $e){
            echo 'Inside catch block';
            echo $e->getMessage();

            $errorMessage = '';
            $duplicateError = Str::contains($e->getMessage(), 'Integrity constraint violation: 1062 Duplicate entry');

            if ($duplicateError){
                $errorMessage = 'Subdivision with name '.$subdivisionName.' already exists. Choose another name.';
            }
            else{
                $errorMessage = $e->getMessage();
            }

            return redirect()->back()->with(['error'=> $errorMessage]);

        }

    }

    function getSubdivisionIdByUserId($userId){

        return DB::table('subdivisions')->where('users_id','=',$userId)->get()->first();
    }

}
