<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuildingManager extends Model
{
    public static function getBillsByMonth($userId, $type){
		$stmt = "SELECT SUM(ub.bill_amount) as bill_amount, a.apartment_number, ub.buildings_id, ub.users_id, b.users_id as bm_id, ub.month 
		FROM apartment_utility_bills as ub JOIN apartments as a ON a.id=ub.apartments_id 
		JOIN buildings as b ON b.id=ub.buildings_id WHERE b.users_id = $userId AND ub.utilities_id = $type GROUP BY ub.month";

        $value = DB::select(DB::raw($stmt));
        return $value;
	}

    public static function getApartmentsUnderBm($userId){
        $sql = "SELECT a.apartment_number, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime FROM `apartments` as a 
		JOIN users as u ON a.users_id = u.id
		JOIN buildings as b ON a.buildings_id=b.id
		WHERE b.users_id = $userId and a.occupancy_status = 'occupied'";

        $value = DB::select(DB::raw($sql));
        return $value;
    }

  

         public static function getUtilityBillsByUserId($userId){
            $sql = "SELECT * FROM `apartment_utility_bills` as ub 
            LEFT JOIN `apartments` as a ON a.id = ub.apartments_id 
            LEFT JOIN buildings as b ON b.id = a.buildings_id
             LEFT JOIN utilities as ut ON ut.id = ub.`utilities_id` 
             WHERE b.users_id = $userId order by a.apartment_number";
             $value = DB::select(DB::raw($sql));
             return $value;


         }


         public static function getCsbReportById($userId){

            $sql = "SELECT a.apartment_number, SUM(acsb.bill_amount) as bill FROM `apartment_community_service_bills` as acsb 
            JOIN `apartments` as a ON a.id=acsb.apartments_id 
            LEFT JOIN buildings as b ON b.id = a.buildings_id 
            WHERE b.users_id = $userId GROUP BY a.apartment_number";

        $value = DB::select(DB::raw($sql));
        return $value;

         }




        public static function getMaintenanceRequestByUserId($userId){
            $sql = "SELECT * FROM `maintenance_requests` as mr 
            JOIN apartments as a ON mr.apartments_id=a.id 
            LEFT JOIN buildings as b ON b.id = a.buildings_id
            WHERE b.users_id = $userId";
                    $value = DB::select(DB::raw($sql));
                    return $value;

        }

        public static function getComplaintsByUserId($userId){
            $sql = "SELECT * FROM `complaints` as mr 
            JOIN apartments as a ON mr.apartments_id=a.id 
            LEFT JOIN buildings as b ON b.id = a.buildings_id
            WHERE b.users_id = $userId";
               $value = DB::select(DB::raw($sql));
               return $value;
        }

        // public static function getMaintenanceRequestByUserId($userId){
        //     $sql = "SELECT * FROM `maintenance_requests` as mr 
        //     JOIN apartments as a ON mr.apartments_id=a.id 
        //     LEFT JOIN buildings as b ON b.id = a.buildings_id
        //     WHERE b.users_id = $userId";
        //                   $value = DB::select(DB::raw($sql));
        //                   return $value;
        // }

}
