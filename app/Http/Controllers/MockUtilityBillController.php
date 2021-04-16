<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\ApartmentUtilityBill;
use App\Models\ElectricityBill;
use App\Models\WaterBill;
use App\Models\GasBill;
use App\Models\InternetBill;

class MockUtilityBillController extends Controller
{
    function addMockUtilityBill(Request $request){

        $utilityServiceProviderTypeController = new ApartmentUtilityServiceProviderTypeController();

        $apartmentId = $request->apartmentId;
        $utilitySPChoiceList = $utilityServiceProviderTypeController->getServiceProviderByApartmentId($apartmentId);

        foreach ($utilitySPChoiceList as $utilitySPChoiceRecord){

            $apartmentUtilityBillRecord = new ApartmentUtilityBill();
            $mockUtilityBillController = new MockUtilityBillController();

            if($utilitySPChoiceRecord->utility_name == 'electricity'){
                $apartmentUtilityBillRecord->bill_amount = $request->electricityBill;
                $mockUtilityBillController->addToElectricityBill($request, $utilitySPChoiceRecord);
            }
            elseif($utilitySPChoiceRecord->utility_name == 'gas'){
                $apartmentUtilityBillRecord->bill_amount = $request->gasBill;
                $mockUtilityBillController->addToGasBill($request, $utilitySPChoiceRecord);
            }
            elseif($utilitySPChoiceRecord->utility_name == 'water'){
                $apartmentUtilityBillRecord->bill_amount = $request->waterBill;
                $mockUtilityBillController->addToWaterBill($request, $utilitySPChoiceRecord);
            }
            elseif($utilitySPChoiceRecord->utility_name == 'internet'){
                $apartmentUtilityBillRecord->bill_amount = $request->internetBill;
                $mockUtilityBillController->addToInternetBill($request, $utilitySPChoiceRecord);
            }

            $apartmentUtilityBillRecord->service_provider_type = $utilitySPChoiceRecord->service_provider_type;
            $apartmentUtilityBillRecord->utility_name = $utilitySPChoiceRecord->utility_name;
            $apartmentUtilityBillRecord->month = $request->month;
            $apartmentUtilityBillRecord->year = $request->year;

            $apartmentUtilityBillRecord->utilities_id = $utilitySPChoiceRecord->utilities_id;
            $apartmentUtilityBillRecord->apartments_id = $utilitySPChoiceRecord->apartments_id;
            $apartmentUtilityBillRecord->buildings_id = $utilitySPChoiceRecord->buildings_id;
            $apartmentUtilityBillRecord->subdivisions_id = $utilitySPChoiceRecord->subdivisions_id;
            $apartmentUtilityBillRecord->users_id = $utilitySPChoiceRecord->users_id;

            $apartmentUtilityBillRecord->save();

        }

        // return response()->json([
        //     'statusCode' => '200',
        //     'message' => 'success',
        //     'error' => '',
        //     'comments' => 'Mock Utility Bill added successfully.',
        //     'apartmentId' => $apartmentId
        // ]);

        $outputResponse =[
                'statusCode' => '200',
                'message' => 'success',
                'error' => '',
                'comments' => 'Mock Utility Bill added successfully.',
                'apartmentId' => $apartmentId
        ];

        return view('city-view.mock-utility-bill', ['outputResponse' => $outputResponse]);
    }

    function addToElectricityBill($request, $utilitySPChoiceRecord){

        $electricityBill = new ElectricityBill();

        $electricityBill->service_provider_type = $utilitySPChoiceRecord->service_provider_type;
        $electricityBill->bill_amount = $request->electricityBill;
        $electricityBill->month = $request->month;
        $electricityBill->year = $request->year;

        $electricityBill->apartments_id = $utilitySPChoiceRecord->apartments_id;
        $electricityBill->buildings_id = $utilitySPChoiceRecord->buildings_id;
        $electricityBill->subdivisions_id = $utilitySPChoiceRecord->subdivisions_id;
        $electricityBill->users_id = $utilitySPChoiceRecord->users_id;

        $electricityBill->save();

    }

    function addToInternetBill($request, $utilitySPChoiceRecord){

        $internetBill = new InternetBill();

        $internetBill->service_provider_type = $utilitySPChoiceRecord->service_provider_type;
        $internetBill->bill_amount = $request->internetBill;
        $internetBill->month = $request->month;
        $internetBill->year = $request->year;

        $internetBill->apartments_id = $utilitySPChoiceRecord->apartments_id;
        $internetBill->buildings_id = $utilitySPChoiceRecord->buildings_id;
        $internetBill->subdivisions_id = $utilitySPChoiceRecord->subdivisions_id;
        $internetBill->users_id = $utilitySPChoiceRecord->users_id;

        $internetBill->save();

    }

    function addToWaterBill($request, $utilitySPChoiceRecord){

        $waterBill = new WaterBill();

        $waterBill->service_provider_type = $utilitySPChoiceRecord->service_provider_type;
        $waterBill->bill_amount = $request->waterBill;
        $waterBill->month = $request->month;
        $waterBill->year = $request->year;

        $waterBill->apartments_id = $utilitySPChoiceRecord->apartments_id;
        $waterBill->buildings_id = $utilitySPChoiceRecord->buildings_id;
        $waterBill->subdivisions_id = $utilitySPChoiceRecord->subdivisions_id;
        $waterBill->users_id = $utilitySPChoiceRecord->users_id;

        $waterBill->save();

    }

    function addToGasBill($request, $utilitySPChoiceRecord){

        $gasBill = new GasBill();

        $gasBill->service_provider_type = $utilitySPChoiceRecord->service_provider_type;
        $gasBill->bill_amount = $request->gasBill;
        $gasBill->month = $request->month;
        $gasBill->year = $request->year;

        $gasBill->apartments_id = $utilitySPChoiceRecord->apartments_id;
        $gasBill->buildings_id = $utilitySPChoiceRecord->buildings_id;
        $gasBill->subdivisions_id = $utilitySPChoiceRecord->subdivisions_id;
        $gasBill->users_id = $utilitySPChoiceRecord->users_id;

        $gasBill->save();

    }
}
