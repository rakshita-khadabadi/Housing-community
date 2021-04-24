<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class MaintenanceRequestController extends Controller
{
    function fetchMaintenanceRequestwithAptId($apartmentId){

        return DB::table('maintenance_requests')
                    ->where('apartments_id','=',$apartmentId)
                    ->get();
    }

    function fetchAllMaintenanceRequests(){

        return MaintenanceRequest::all();
    }

    function saveMaintenanceRequest($mrMessage, $apartmentId,$apartment){

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $mrRequest = new MaintenanceRequest();
        $mrRequest->message = $mrMessage;
        $mrRequest->status = 'open';
        $mrRequest->message_datetime = $current_date_time;
        $mrRequest->apartments_id = $apartmentId;
        $date = new DateTime("now", new DateTimeZone('America/Chicago') );
		$mrRequest->message_datetime = $date->format('Y-m-d H:i:s');
		$mrRequest->month = $date->format('m');
		$mrRequest->year = $date->format('Y');
		$mrRequest->buildings_id = $apartment->buildings_id;
		$mrRequest->subdivisions_id = $apartment->subdivisions_id;
		$mrRequest->users_id = $apartment->users_id;

        try{
            $mrRequest->save();

            $successMessage = 'Successfully raised new Maintenance Request';
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
