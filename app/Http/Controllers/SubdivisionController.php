<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use Exception;
use Illuminate\Support\Str;

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

            // return response()->json([
            //     'statusCode' => '200',
            //     'message' => 'success',
            //     'error' => $e->getMessage(),
            //     'comments' => 'Added new subdivision.',
            //     'subdivisionId' => $subdivision->id
            // ]);
            $successMessage = 'Successfully added Subdivision '.$subdivisionName;
            return redirect()->back()->with(['success'=> $successMessage]);
        }
        catch(Exception $e){
            echo 'Inside catch block';
            echo $e->getMessage();
            
            // return response()->json([
            //     'statusCode' => '500',
            //     'message' => 'failed',
            //     'error' => $e->getMessage(),
            //     'comments' => 'Failed to add new subdivision.'
            // ]);

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
}
