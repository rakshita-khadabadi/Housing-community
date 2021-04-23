<?php

namespace App\Http\Controllers;

use App\Models\BuildingManager;
use Illuminate\Http\Request;
use stdClass;

class BuildingManagerController extends Controller
{
    function initializeBuildingManager(Request $request){

        $userId = $request['userId'];
        

        $userController = new UserController();
        $personalDetails = $userController->getUserById($userId);
        //  echo $personalDetails;
        $billJson = 0;
        $eJson = [];
        $electricityBill= $this->getElectricityBill($userId);
        $gasBill=$this->getGasBill($userId);
        $waterBill=$this->getWaterBill($userId);
        $apartments = $this->getApartmentDetails($userId);
        $utils=$this->getUtilityBills($userId);
        $csb=$this-> getCommunityServiceBils($userId);
        $mr=$this->getMaintenanceRequestReport($userId);
        $complaints=$this->getComplaintReport($userId);

        

        return view('city-view.post-login.building-manager.building-manager', [
            'user' => $personalDetails,
            'electricityBill' => $electricityBill,
            'gasBill'=> $gasBill,
            'waterBill'=>$waterBill,
            'apartments' => $apartments,
            'utils' => $utils,
            'csb'=>$csb,
            'mr'=>$mr,
            'complaints'=>$complaints
            ]);
    }


    function getElectricityBill($userId){
    //    $BuldingManager= new BuildingManager();
                    $electricityByMonth = BuildingManager::getBillsByMonth($userId, 1);
                    $electricity = [];
                    $bill = [];
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    // echo json_encode($electricityByMonth);
                    foreach($electricityByMonth as $em){
                       
                        array_push($electricity, $months[$em->month - 1]);
                        array_push($bill, $em->bill_amount);
                    }
                    array_push($bill, 0);
                    array_push($bill, 70);
                   return $this->createObj($electricity, $bill);
      
    }

    function getGasBill($userId) {
        $gasByMonth = BuildingManager::getBillsByMonth($userId, 3);
        // var_dump($gasByMonth);
        $gas = array();
        $bill = array();
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        foreach($gasByMonth as $em){
            array_push($gas, $months[$em->month- 1]);
            array_push($bill, $em->bill_amount);
        }
        array_push($bill, 0);
        return $this->createObj($gas, $bill);
    }

    function getWaterBill($userId) {
        $waterByMonth = BuildingManager::getBillsByMonth($userId, 2);
        // var_dump($waterByMonth);
        $water = array();
        $bill = array();
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        foreach($waterByMonth as $em){
            array_push($water, $months[$em->month- 1]);
            array_push($bill, $em->bill_amount);
        }
        array_push($bill, 0);
        // return $this->createObj($water, $bill);
        $object = new stdClass();
        $object->eJson = json_encode($water);
        $object->billJson = json_encode($bill);
        // // var_dump($object);
        return $object;
    }

    function getApartmentDetails($userId){
        return BuildingManager::getApartmentsUnderBm($userId);
    }

    function createObj($labels, $values){
        $object = new stdClass();
        $object->eJson = json_encode($labels);
        $object->billJson = json_encode($values);
        // // var_dump($object);
        return $object;
    }
    function getUtilityBills($userId){
        return BuildingManager::getUtilityBillsByUserId($userId);
    }
    function getCommunityServiceBils($userId){
        return BuildingManager::getCsbReportById($userId);
    }

    function getMaintenanceRequestReport($userId){

        return BuildingManager::getMaintenanceRequestByUserId($userId);
    }

    function getComplaintReport($userId){
        return BuildingManager::getComplaintsByUserId($userId);
    }

    function viewMaintenanceRequest($userId){
        return BuildingManager::getMaintenanceRequestByUserId($userId);
    }

}
