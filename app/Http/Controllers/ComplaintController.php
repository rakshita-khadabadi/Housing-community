<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class ComplaintController extends Controller
{
    //
    function fetchCompliantRequestwithAptId($apartmentId){

        return DB::table('complaints')
                    ->where('apartments_id','=',$apartmentId)
                    ->get();
    }

    function fetchAllComplaintRequests(){
        
        return MaintenanceRequest::all();
    }

    function saveComplaintRequest($mrMessage, $apartmentId,$apartment){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $crRequest = new Complaint();
        $crRequest->message = $mrMessage;
        $crRequest->status = 'open';
        $crRequest->message_datetime = $current_date_time;
        $crRequest->apartments_id = $apartmentId;
        $date = new DateTime("now", new DateTimeZone('America/Chicago') );
		$crRequest->month = $date->format('m');
		$crRequest->year = $date->format('Y');
        $crRequest->buildings_id = $apartment->buildings_id;
		$crRequest->subdivisions_id = $apartment->subdivisions_id;
		$crRequest->users_id = $apartment->users_id;

        try{
            $crRequest->save();

            $successMessage = 'Successfully raised new Complaint';
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
