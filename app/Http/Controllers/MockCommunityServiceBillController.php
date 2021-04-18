<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApartmentCommunityServiceBill;

class MockCommunityServiceBillController extends Controller
{
    function addCommunityServiceBill(Request $request){

        $communityServiceController = new CommunityServiceController();
        $communityServiceList = $communityServiceController->getAllCommunityServices();

        $apartmentId = $request->apartmentId;

        $apartmentController = new ApartmentController();
        $apartmentRecord = $apartmentController->getApartmentById($apartmentId);

        foreach ($communityServiceList as $communityService){

            $apartmentCSBill = new ApartmentCommunityServiceBill();

            if($communityService->community_service_name == 'maintenance fee'){
                $apartmentCSBill->bill_amount = $request->maintenanceBill;
            }
            elseif($communityService->community_service_name == 'gym'){
                $apartmentCSBill->bill_amount = $request->gymBill;
            }
            elseif($communityService->community_service_name == 'pool'){
                $apartmentCSBill->bill_amount = $request->poolBill;
            }

            $apartmentCSBill->month = $request->month;
            $apartmentCSBill->year = $request->year;
            $apartmentCSBill->community_services_id = $communityService->id;
            $apartmentCSBill->apartments_id = $apartmentId;
            $apartmentCSBill->buildings_id = $apartmentRecord->buildings_id;
            $apartmentCSBill->subdivisions_id = $apartmentRecord->subdivisions_id;
            $apartmentCSBill->users_id = $apartmentRecord->users_id;

            $apartmentCSBill->save();
        }

        $successMessage = 'Mock Community Service Bill added successfully for apartmentId = '.$apartmentId;
        return redirect()->back()->with(['success'=> $successMessage]);

    }
}
