<?php

use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\PeopleAddressController;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('change-password', [AdminController::class,'changePassword'])->name('change-password');
    Route::put('change-password', [AdminController::class,'changePasswordUpdate'])->name('change-password-update');

    Route::group(['middleware' => ['superadmin']], function () {
        //superadmin role routes goes here
        Route::resource('admin-users', AdminController::class);
    });
    Route::group(['middleware' => ['Permission']], function () {
        //admin role routes goes here
        Route::resource('address-types', AddressTypeController::class);
        Route::resource('peoples', PeopleController::class);
        Route::get('people-addresses/create/{people_id}', [PeopleAddressController::class,'create'])->name('people-addresses.create');
        Route::post('people-addresses/store', [PeopleAddressController::class,'store'])->name('people-addresses.store');
        Route::get('people-addresses/{people_id}', [PeopleAddressController::class,'index'])->name('people-addresses.index');
        Route::get('people-addresses/{id}/edit', [PeopleAddressController::class,'edit'])->name('people-addresses.edit');
        Route::put('people-addresses/{id}',[PeopleAddressController::class,'update'])->name('people-addresses.update');
        Route::delete('people-addresses/{id}',[PeopleAddressController::class,'destroy'])->name('people-addresses.destroy');
    });
});
