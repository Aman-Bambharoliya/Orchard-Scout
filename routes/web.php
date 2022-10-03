<?php

use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CropCommodityTypeController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPhoneController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\PeopleAddressController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PeoplePhoneController;
use App\Models\CropCommodityType;
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

        //people-address route start===================================================
        Route::get('people-addresses/create/{people_id}', [PeopleAddressController::class,'create'])->name('people-addresses.create');
        Route::post('people-addresses/store', [PeopleAddressController::class,'store'])->name('people-addresses.store');
        Route::get('people-addresses/{people_id}', [PeopleAddressController::class,'index'])->name('people-addresses.index');
        Route::get('people-addresses/{id}/edit', [PeopleAddressController::class,'edit'])->name('people-addresses.edit');
        Route::put('people-addresses/{id}',[PeopleAddressController::class,'update'])->name('people-addresses.update');
        Route::delete('people-addresses/{id}',[PeopleAddressController::class,'destroy'])->name('people-addresses.destroy');
        //people-address route end===================================================

         //people-phones route start===================================================
         Route::get('people-phones/create/{people_id}', [PeoplePhoneController::class,'create'])->name('people-phones.create');
         Route::post('people-phones/store', [PeoplePhoneController::class,'store'])->name('people-phones.store');
         Route::get('people-phones/{people_id}', [PeoplePhoneController::class,'index'])->name('people-phones.index');
         Route::get('people-phones/{id}/edit', [PeoplePhoneController::class,'edit'])->name('people-phones.edit');
         Route::put('people-phones/{id}',[PeoplePhoneController::class,'update'])->name('people-phones.update');
         Route::delete('people-phones/{id}',[PeoplePhoneController::class,'destroy'])->name('people-phones.destroy');
         //people-address route end===================================================

         Route::resource('customers', CustomerController::class);

         //customers-address route start===================================================
        Route::get('customer-addresses/create/{customer_id}', [CustomerAddressController::class,'create'])->name('customer-addresses.create');
        Route::post('customer-addresses/store', [CustomerAddressController::class,'store'])->name('customer-addresses.store');
        Route::get('customer-addresses/{customer_id}', [CustomerAddressController::class,'index'])->name('customer-addresses.index');
        Route::get('customer-addresses/{id}/edit', [CustomerAddressController::class,'edit'])->name('customer-addresses.edit');
        Route::put('customer-addresses/{id}',[CustomerAddressController::class,'update'])->name('customer-addresses.update');
        Route::delete('customer-addresses/{id}',[CustomerAddressController::class,'destroy'])->name('customer-addresses.destroy');
        //customers-address route end===================================================

        //customer-phones route start===================================================
        Route::get('customer-phones/create/{people_id}', [CustomerPhoneController::class,'create'])->name('customer-phones.create');
        Route::post('customer-phones/store', [CustomerPhoneController::class,'store'])->name('customer-phones.store');
        Route::get('customer-phones/{people_id}', [CustomerPhoneController::class,'index'])->name('customer-phones.index');
        Route::get('customer-phones/{id}/edit', [CustomerPhoneController::class,'edit'])->name('customer-phones.edit');
        Route::put('customer-phones/{id}',[CustomerPhoneController::class,'update'])->name('customer-phones.update');
        Route::delete('customer-phones/{id}',[CustomerPhoneController::class,'destroy'])->name('customer-phones.destroy');
        //customer-phones route end===================================================
        Route::resource('crop-commodity-types', CropCommodityTypeController::class);

    });
});
