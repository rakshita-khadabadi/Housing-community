<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class ApartmentOwnerController extends Controller
{
    function initializeApartmentOwner(Request $request){

        $userId = $request['userId'];

        $userController = new UserController();
        $personalDetails = $userController->getUserById($userId);
        //echo 'Hi its working';

        $apartmentOwnerController = new ApartmentOwnerController();
        $utilityReportMonth = $apartmentOwnerController->getPreviousMonth();

        $utilityReportYear = $apartmentOwnerController->getPreviousMonthYear();

        $apartmentController = new ApartmentController();
        $apartmentRecord = $apartmentController->getApartmentByUserId($userId);
        $apartmentId =  $apartmentRecord->id;

        $communityServiceBillRecordList = $apartmentOwnerController->getLastMonthCommunityServiceReport($apartmentId, $utilityReportMonth, $utilityReportYear);
        $communityServiceBillTotal = $apartmentOwnerController->getCommunityServiceBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);
        // echo json_encode($communityServiceBillTotal);
        // echo json_encode($communityServiceBillRecordList);
        $utilityBillRecordList = $apartmentOwnerController->getLastMonthUtilityReport($apartmentId, $utilityReportMonth, $utilityReportYear);
        //echo json_encode($utilityBillRecordList);
        $utilityBillTotal = $apartmentOwnerController->getUtilityBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);


        return view('city-view.post-login.apartment.apartment-owner', [
            'personalDetails' => $personalDetails,
            'utilityReportMonth' => $utilityReportMonth,
            'utilityReportYear' => $utilityReportYear,
            'utilityBillRecordList' => $utilityBillRecordList,
            // 'apartmentCount' => $apartmentCount,
            // 'electricityBillTotal' => $electricityBillTotal,
            // 'gasBillTotal' => $gasBillTotal,
            // 'waterBillTotal' => $waterBillTotal,
             'utilityBillTotal' => $utilityBillTotal,
            // 'monthLabels' => $monthLabels,
            // 'electricityBillLabels' => $electricityBillLabels,
            // 'gasBillLabels' => $gasBillLabels,
            // 'waterBillLabels' => $waterBillLabels,
            'communityServiceBillRecordList' => $communityServiceBillRecordList,
            // 'apartmentCountCommunityService' => $apartmentCountCommunityService,
             'communityServiceBillTotal' => $communityServiceBillTotal
            // 'buildingList' => $buildingList,
            // 'aptList' => $aptList,
            // 'itrlist' => $itrlist
            ]);
        //return $personalDetails;
        //echo "printing personal details";
        // return view('city-view.post-login.subdivision.subdivision-manager', [
        //     'personalDetails' => $personalDetails,
            
        //     ]);
   
   
    }

    function getPreviousMonth(){
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		return $month;
	}
    function getPreviousMonthYear(){
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );

		return  $date->format('Y');
	}
    function getCommunityServiceBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){

        return DB::table('apartment_community_service_bills AS acsb')
            ->select(DB::raw('SUM(acsb.bill_amount) as total_community_service_bill'))
            ->where('acsb.apartments_id','=',$apartmentId)
            ->where('acsb.month','=',$utilityReportMonth)
            ->where('acsb.year',"=",$utilityReportYear)
            ->get()->first();
    }

    function getLastMonthCommunityServiceReport($apartmentId, $utilityReportMonth, $utilityReportYear){
        //echo $apartmentId, $utilityReportMonth, $utilityReportYear;
        return DB::table('apartment_community_service_bills AS acsb')
            ->select('acsb.bill_amount', 'cs.community_service_name')
            ->join('community_services AS cs','cs.id','=','acsb.community_services_id')
            ->where('acsb.apartments_id','=',$apartmentId)
            ->where('acsb.month','=',$utilityReportMonth)
            ->where('acsb.year',"=",$utilityReportYear)
            ->get();
    }

    function getLastMonthUtilityReport($apartmentId, $utilityReportMonth, $utilityReportYear){
        
        return DB::table('apartment_utility_bills AS aub')
            ->select('aub.bill_amount','u.utility_name','aub.service_provider_type')
            ->join('utilities AS u','aub.utilities_id','=','u.id')
            ->where('aub.apartments_id','=',$apartmentId)
            ->where('aub.month','=',$utilityReportMonth)
            ->where('aub.year',"=",$utilityReportYear)
            ->get();
    }

    function getUtilityBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){
        
        return DB::table('apartment_utility_bills AS aub')
            ->select(DB::raw('SUM(aub.bill_amount) as total_utility_bill'))
            ->where('aub.apartments_id','=',$apartmentId)
            ->where('aub.month','=',$utilityReportMonth)
            ->where('aub.year',"=",$utilityReportYear)
            ->get()->first();
    }


    //
}
