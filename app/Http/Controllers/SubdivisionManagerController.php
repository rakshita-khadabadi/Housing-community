<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class SubdivisionManagerController extends Controller
{
    function initializeSubdivisionManager(Request $request){

        $userId = $request['userId'];

        $userController = new UserController();
        $personalDetails = $userController->getUserById($userId);
        // echo $personalDetails;
        $subdivisionManagerController = new SubdivisionManagerController();
        $utilityReportMonth = $subdivisionManagerController->getPreviousMonth();
        // echo $utilityReportMonth;

        $utilityReportYear = $subdivisionManagerController->getPreviousMonthYear();
        // echo $utilityReportYear;

        $utilityBillRecordList = $subdivisionManagerController->fetchUtilityReportOfSubdivision($userId, $utilityReportMonth, $utilityReportYear);

        return view('city-view.post-login.subdivision.subdivision-manager', [
            'personalDetails' => $personalDetails,
            'utilityReportMonth' => $utilityReportMonth,
            'utilityReportYear' => $utilityReportYear,
            'utilityBillRecordList' => $utilityBillRecordList
            ]);
    }

    function checkFeature(){
        echo 'Inside checkFeature';
    }

    function fetchUtilityReportOfSubdivision($userId, $utilityReportMonth, $utilityReportYear){
        
        $subdivisionController = new SubdivisionController();
        $subdivisionRecord = $subdivisionController->getSubdivisionIdByUserId($userId);
        // echo json_encode($subdivisionRecord);

        $subdivisionId = $subdivisionRecord->id;
        $subdivisionManagerController = new SubdivisionManagerController();
        $utilityReport = $subdivisionManagerController->getLastMonthUtilityReport($subdivisionId, $utilityReportMonth, $utilityReportYear);
        // echo $utilityReport;
        return $utilityReport;

    }

    function getLastMonthUtilityReport($subdivisionId, $utilityReportMonth, $utilityReportYear){
        
        return DB::table('electricity_bills AS eb')
            ->select('b.building_name', 'a.apartment_number','eb.bill_amount as electricity_bill', 
            'gb.bill_amount as gas_bill', 'wb.bill_amount as water_bill',
            DB::raw('eb.bill_amount + gb.bill_amount + wb.bill_amount as total'))
            ->join('gas_bills AS gb','gb.subdivisions_id','=','eb.subdivisions_id')
            ->join('water_bills AS wb','wb.subdivisions_id','=','eb.subdivisions_id')
            ->join('buildings AS b','b.id','=','eb.buildings_id')
            ->join('apartments AS a','a.id','=','eb.apartments_id')
            ->where('eb.subdivisions_id','=',$subdivisionId)
            ->where('eb.month','=',$utilityReportMonth)
            ->where('eb.year',"=",$utilityReportYear)
            ->get();
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

}
