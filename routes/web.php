<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MockUtilityBillController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     return 'Amlan Alok';
// })->name('home.basic');

Route::get('/getinfo/{id}', function ($id){
    return 'get info '. $id;
})
// ->where([
//     'id' => '[0-9]+'                // this is regex constraint to check only numerial value is passed for $id
// ])
->name('home.get');

Route::get('/get-s/{id?}', function ($studentId = 9){
    return 'get-s'. $studentId;
})->name('home.get?');

// Route::get('/getUser/{userId}', [Users::class, 'getUserById']);

// By default, csrf token is required. This can be over ridden from Http/Middleware/VerifyCsrfToken.php
// Route::post('/saveUser', [Users::class, 'saveUser']);


// Route::get('/', function(){
//     return view('city-view.index', []);
// })->name('home.index');

Route::view('/', 'city-view.index')->name('city-view.index');

Route::get('/change', function() {
    return redirect('/showRoles');
});

Route::view('/mock-utility-bill', 'city-view.mock-utility-bill')->name('city-view.mock-utility-bill');

Route::post('/mock-utility-bill', [MockUtilityBillController::class, 'addMockUtilityBill']);

Route::get('/showRoles', [RoleController::class, 'getRoles']);

// Route::view('/admin', 'city-view.post-login.admin.admin')->name('city-view.post-login.admin.admin');
Route::get('/admin', [AdminController::class, 'initializeAdmin']);
Route::post('/admin', [AdminController::class, 'checkFeature']);
