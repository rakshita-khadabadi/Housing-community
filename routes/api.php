<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SubdivisionController;
use App\Http\Controllers\BuildingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/saveUser', [SignUpController::class, 'signUpNewUser']);
Route::get('/getUser/{userId}', [UserController::class, 'getUserById']);
Route::post('/addSubdivision', [SubdivisionController::class, 'addNewSubdivision']);
Route::post('/addBuilding', [BuildingController::class, 'addNewBuilding']);

Route::get('/getRoles', [RoleController::class, 'getRoles']);
