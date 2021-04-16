<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentUtilityServiceProviderTypeController extends Controller
{
    
    function getServiceProviderByApartmentId($apartmentId){

        return DB::table('apartment_utility_service_provider_types')->where('apartments_id', '=', $apartmentId)->get();
    }
}
