<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleController extends Controller
{

    function getSignUpRoles(){
        $roleList = DB::table('roles')->where('role_name','!=','admin')->get();
        return $roleList;
    }

    function getRoles(){

        // return Role::all();

        // abort_if(isset($roleList[0]), 404);      // if isset returns false then the page will show a 404 error
        $roleList = Role::all();
        return view('city-view.index', ['roleList' => $roleList]);
    }

    function getRoleByName($roleName){
        return DB::table('roles')->where('role_name','=',$roleName)->get()->first();
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
