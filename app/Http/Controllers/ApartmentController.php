<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    function fetchAllEmptyApartments(){

        return DB::table('apartments')->where('occupancy_status','=','empty')->get();
    }

    function getApartmentById($apartmentId){

        return Apartment::find($apartmentId);
    }
    
    function getApartmentByUserId($userId){
        return DB::table('apartments')->where('users_id','=',$userId)->get()->first(); 
    }

    function addApartmentsToBuilding($request, $buildingId, $subdivisionId, $userId){

        for ($i=1; $i<=4; $i = $i+1){
            for ($j=1; $j<=4; $j = $j+1){
                
                $apartmentIndex = 'apt-num-f'.$i.'-a'.$j;
                
                $apartment = new Apartment();
                $apartment->apartment_number = $request->$apartmentIndex;
                $apartment->occupancy_status = 'empty';
                $apartment->buildings_id = $buildingId;
                $apartment->subdivisions_id = $subdivisionId;
                $apartment->users_id = $userId;

                $apartment->save();
            }
        }

    }
}
