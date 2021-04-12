<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleController extends Controller
{

    function getRoles(){

        return Role::all();
    }

    function getRoleById($roleId){

        return Role::find($roleId);
    }

    function getAdminUserId(){

        $adminRoleRecord = DB::table('roles')->where('role_name', '=', 'admin')->get();
        // return $adminRoleRecord;
        $adminRoleId = $adminRoleRecord->first()->id;
        // echo $adminRoleId;
        return Role::find($adminRoleId)->getUser()->first()->id;

    }
}
