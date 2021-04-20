<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\ItRequest;
use Illuminate\Support\Facades\DB;

class ItRequestController extends Controller
{
    function fetchItRequestWithSubdivisionId($subdivisionId){

        return DB::table('it_requests')
                    ->where('subdivisions_id','=',$subdivisionId)
                    ->get();
    }

    function fetchAllItRequests(){
        
        return ItRequest::all();
    }

    function saveItRequest($itrMessage, $subdivisionId){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $itrRequest = new ItRequest();
        $itrRequest->message = $itrMessage;
        $itrRequest->status = 'open';
        $itrRequest->message_datetime = $current_date_time;
        $itrRequest->subdivisions_id = $subdivisionId;

        try{
            $itrRequest->save();

            $successMessage = 'Successfully raised new IT Request';
            return redirect()->back()->with(['success'=> $successMessage]);
        }
        catch(Exception $e){
            echo 'Inside catch block';
            echo $e->getMessage();

            $errorMessage = $e->getMessage();

            return redirect()->back()->with(['error'=> $errorMessage]);

        }
        
    }
}