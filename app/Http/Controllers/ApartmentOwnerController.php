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

        $mrRequestController = new MaintenanceRequestController();
        $mrlist = $mrRequestController->fetchMaintenanceRequestwithAptId($apartmentId);

        $crRequestController =  new ComplaintController();
        $crlist = $crRequestController->fetchCompliantRequestwithAptId($apartmentId);

        $electricityBillTotal = $apartmentOwnerController->getElectricityBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);
        $electricityBillLabels = json_encode($apartmentOwnerController->getElectricityChartLabels($apartmentId));

        $internetBillTotal = $apartmentOwnerController->getInternetBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);
        $internetBillLabels = json_encode($apartmentOwnerController->getInternetChartLabels($apartmentId));

        $gasBillTotal = $apartmentOwnerController->getGasBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);
        $waterBillTotal = $apartmentOwnerController->getWaterBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear);
        
        $gasBillLabels = json_encode($apartmentOwnerController->getGasChartLabels($apartmentId));
        $waterBillLabels = json_encode($apartmentOwnerController->getWaterChartLabels($apartmentId));

        $subdivisionManagerUserId = $apartmentOwnerController->getApartmentsSMUserId($apartmentId);
        // echo $subdivisionManagerUserId;

        $monthLabels = json_encode(['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec']);
        return view('city-view.post-login.apartment.apartment-owner', [
            'personalDetails' => $personalDetails,
            'utilityReportMonth' => $utilityReportMonth,
            'utilityReportYear' => $utilityReportYear,
            'utilityBillRecordList' => $utilityBillRecordList,
            // 'apartmentCount' => $apartmentCount,
            'electricityBillTotal' => $electricityBillTotal,
             'gasBillTotal' => $gasBillTotal,
            'waterBillTotal' => $waterBillTotal,
             'utilityBillTotal' => $utilityBillTotal,
             'monthLabels' => $monthLabels,
             'electricityBillLabels' => $electricityBillLabels,
            'gasBillLabels' => $gasBillLabels,
             'waterBillLabels' => $waterBillLabels,
            'communityServiceBillRecordList' => $communityServiceBillRecordList,
            'internetBillTotal' => $internetBillTotal,
            'internetBillLabels' => $internetBillLabels,
            // 'apartmentCountCommunityService' => $apartmentCountCommunityService,
             'communityServiceBillTotal' => $communityServiceBillTotal,
            // 'buildingList' => $buildingList,
            // 'aptList' => $aptList,
             'mrlist' => $mrlist,
             'crlist' => $crlist,
             'subdivisionManagerUserId' => $subdivisionManagerUserId
            ]);
        //return $personalDetails;
        //echo "printing personal details";
        // return view('city-view.post-login.subdivision.subdivision-manager', [
        //     'personalDetails' => $personalDetails,
            
        //     ]);
   
   
    }

    function checkFeature(Request $request){
        echo 'Inside checkFeature';

        $userId = $request['userId'];

        if (isset($request['maintenance-request-input-message'])){
            echo 'add maintenance request feature has been called.';
            $mrMessage = $request['maintenance-request-input-message'];
            
            $apartmentController = new ApartmentController();
            $apartmentRecord = $apartmentController->getApartmentByUserId($userId);
            $apartmentId = $apartmentRecord->id;
            $mrRequestController = new MaintenanceRequestController();
            return $mrRequestController->saveMaintenanceRequest($mrMessage, $apartmentId,$apartmentRecord);

        }
        if (isset($request['complaints-request-input-message'])){
            echo 'add maintenance request feature has been called.';
            $crMessage = $request['complaints-request-input-message'];
            
            $apartmentController = new ApartmentController();
            $apartmentRecord = $apartmentController->getApartmentByUserId($userId);
            $apartmentId = $apartmentRecord->id;

            $crRequestController = new ComplaintController();
            return $crRequestController->saveComplaintRequest($crMessage, $apartmentId,$apartmentRecord);

        }
    }

    function getApartmentsSMUserId($apartmentId){
        
        $apartmentController = new ApartmentController();
        $apartmentRecord = $apartmentController->getApartmentById($apartmentId);

        $subdivisionId = $apartmentRecord->subdivisions_id;

        $subdivisionController = new SubdivisionController();
        $subdivisionRecord = $subdivisionController->getSubdivisionById($subdivisionId);

        return $subdivisionRecord->users_id;
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

    function getElectricityBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){

        return DB::table('electricity_bills AS eb')
            ->select(DB::raw('SUM(eb.bill_amount) as total_electricity_bill'))
            ->where('eb.apartments_id','=',$apartmentId)
            ->where('eb.month','=',$utilityReportMonth)
            ->where('eb.year',"=",$utilityReportYear)
            ->get()->first();
    }
    function getGasBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){

        return DB::table('gas_bills AS eb')
            ->select(DB::raw('SUM(eb.bill_amount) as total_gas_bill'))
            ->where('eb.apartments_id','=',$apartmentId)
            ->where('eb.month','=',$utilityReportMonth)
            ->where('eb.year',"=",$utilityReportYear)
            ->get()->first();
    }

    function getWaterBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){

        return DB::table('water_bills AS eb')
            ->select(DB::raw('SUM(eb.bill_amount) as total_water_bill'))
            ->where('eb.apartments_id','=',$apartmentId)
            ->where('eb.month','=',$utilityReportMonth)
            ->where('eb.year',"=",$utilityReportYear)
            ->get()->first();
    }

    function getInternetBillTotal($apartmentId, $utilityReportMonth, $utilityReportYear){

        return DB::table('internet_bills AS eb')
            ->select(DB::raw('SUM(eb.bill_amount) as total_internet_bill'))
            ->where('eb.apartments_id','=',$apartmentId)
            ->where('eb.month','=',$utilityReportMonth)
            ->where('eb.year',"=",$utilityReportYear)
            ->get()->first();
    }

    function getElectricityChartLabels($apartmentId){

        $electricityLabels = [];
        $date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$currentYear = $date->format('Y');

        for ($i=1; $i<=12; $i=$i+1){

            $currentMonth = $i;

            $monthTotal = DB::table('electricity_bills AS eb')
                        ->select(DB::raw('SUM(eb.bill_amount) as total_electricity_bill'))
                        ->where('eb.apartments_id','=',$apartmentId)
                        ->where('eb.month','=',$currentMonth)
                        ->where('eb.year',"=",$currentYear)
                        ->get()->first();

            if ($monthTotal->total_electricity_bill == null){
                array_push($electricityLabels, 0);
            }
            else{
                array_push($electricityLabels, $monthTotal->total_electricity_bill);
            }
            
        }

        return $electricityLabels;
    }
    function getGasChartLabels($apartmentId){

        $gasLabels = [];
        $date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$currentYear = $date->format('Y');

        for ($i=1; $i<=12; $i=$i+1){

            $currentMonth = $i;

            $monthTotal = DB::table('gas_bills AS gb')
                        ->select(DB::raw('SUM(gb.bill_amount) as total_gas_bill'))
                        ->where('gb.apartments_id','=',$apartmentId)
                        ->where('gb.month','=',$currentMonth)
                        ->where('gb.year',"=",$currentYear)
                        ->get()->first();

            if ($monthTotal->total_gas_bill == null){
                array_push($gasLabels, 0);
            }
            else{
                array_push($gasLabels, $monthTotal->total_gas_bill);
            }
            
        }

        return $gasLabels;
    }

    function getWaterChartLabels($apartmentId){

        $waterLabels = [];
        $date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$currentYear = $date->format('Y');

        for ($i=1; $i<=12; $i=$i+1){

            $currentMonth = $i;

            $monthTotal = DB::table('water_bills AS wb')
                        ->select(DB::raw('SUM(wb.bill_amount) as total_water_bill'))
                        ->where('wb.apartments_id','=',$apartmentId)
                        ->where('wb.month','=',$currentMonth)
                        ->where('wb.year',"=",$currentYear)
                        ->get()->first();

            if ($monthTotal->total_water_bill == null){
                array_push($waterLabels, 0);
            }
            else{
                array_push($waterLabels, $monthTotal->total_water_bill);
            }
            
        }

        return $waterLabels;
    }

    function getInternetChartLabels($apartmentId){

        $InternetLabels = [];
        $date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$currentYear = $date->format('Y');

        for ($i=1; $i<=12; $i=$i+1){

            $currentMonth = $i;

            $monthTotal = DB::table('internet_bills AS ib')
                        ->select(DB::raw('SUM(ib.bill_amount) as total_internet_bill'))
                        ->where('ib.apartments_id','=',$apartmentId)
                        ->where('ib.month','=',$currentMonth)
                        ->where('ib.year',"=",$currentYear)
                        ->get()->first();

            if ($monthTotal->total_internet_bill == null){
                array_push($InternetLabels, 0);
            }
            else{
                array_push($InternetLabels, $monthTotal->total_internet_bill);
            }
            
        }

        return $InternetLabels;
    }


    //
}
