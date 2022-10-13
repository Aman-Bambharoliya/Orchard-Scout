<?php

use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CropCommodityController;
use App\Http\Controllers\CropCommodityTypeController;
use App\Http\Controllers\CropCommodityVarietyController;
use App\Http\Controllers\CropLocationBlockController;
use App\Http\Controllers\CropLocationController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPeopleController;
use App\Http\Controllers\CustomerPhoneController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\PeopleAddressController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PeoplePhoneController;
use App\Http\Controllers\VendorAddressController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorPeopleController;
use App\Http\Controllers\VendorPhoneController;
use App\Models\CropCommodityType;
use App\Models\CropLocation;
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
        Route::get('customer-phones/create/{customer_id}', [CustomerPhoneController::class,'create'])->name('customer-phones.create');
        Route::post('customer-phones/store', [CustomerPhoneController::class,'store'])->name('customer-phones.store');
        Route::get('customer-phones/{customer_id}', [CustomerPhoneController::class,'index'])->name('customer-phones.index');
        Route::get('customer-phones/{id}/edit', [CustomerPhoneController::class,'edit'])->name('customer-phones.edit');
        Route::put('customer-phones/{id}',[CustomerPhoneController::class,'update'])->name('customer-phones.update');
        Route::delete('customer-phones/{id}',[CustomerPhoneController::class,'destroy'])->name('customer-phones.destroy');
        //customer-phones route end===================================================
        Route::resource('crop-commodity-types', CropCommodityTypeController::class);
        Route::resource('crop-commodities', CropCommodityController::class);
        Route::resource('crop-commodity-varieties', CropCommodityVarietyController::class);
        Route::resource('crop-locations', CropLocationController::class);
        Route::get('/get-customer-addresses/{id}', [HelperController::class, 'getCustomerAddressesById'])->name('get-customer-addresses');
        Route::resource('crop-location-blocks', CropLocationBlockController::class);

        //customer-peoples route start===================================================
        Route::get('customer-peoples/create/{customer_id}', [CustomerPeopleController::class,'create'])->name('customer-peoples.create');
        Route::post('customer-peoples/store', [CustomerPeopleController::class,'store'])->name('customer-peoples.store');
        Route::get('customer-peoples/{customer_id}', [CustomerPeopleController::class,'index'])->name('customer-peoples.index');
        Route::get('customer-peoples/{id}/edit', [CustomerPeopleController::class,'edit'])->name('customer-peoples.edit');
        Route::put('customer-peoples/{id}',[CustomerPeopleController::class,'update'])->name('customer-peoples.update');
        Route::delete('customer-peoples/{id}',[CustomerPeopleController::class,'destroy'])->name('customer-peoples.destroy');
        //customer-peoples route end===================================================

        Route::resource('vendors', VendorController::class);

        //vendor-addresses route start===================================================
       Route::get('vendor-addresses/create/{vendor_id}', [VendorAddressController::class,'create'])->name('vendor-addresses.create');
       Route::post('vendor-addresses/store', [VendorAddressController::class,'store'])->name('vendor-addresses.store');
       Route::get('vendor-addresses/{vendor_id}', [VendorAddressController::class,'index'])->name('vendor-addresses.index');
       Route::get('vendor-addresses/{id}/edit', [VendorAddressController::class,'edit'])->name('vendor-addresses.edit');
       Route::put('vendor-addresses/{id}',[VendorAddressController::class,'update'])->name('vendor-addresses.update');
       Route::delete('vendor-addresses/{id}',[VendorAddressController::class,'destroy'])->name('vendor-addresses.destroy');
       //vendor-addresses route end===================================================

       //vendor-phones route start===================================================
       Route::get('vendor-phones/create/{vendor_id}', [VendorPhoneController::class,'create'])->name('vendor-phones.create');
       Route::post('vendor-phones/store', [VendorPhoneController::class,'store'])->name('vendor-phones.store');
       Route::get('vendor-phones/{vendor_id}', [VendorPhoneController::class,'index'])->name('vendor-phones.index');
       Route::get('vendor-phones/{id}/edit', [VendorPhoneController::class,'edit'])->name('vendor-phones.edit');
       Route::put('vendor-phones/{id}',[VendorPhoneController::class,'update'])->name('vendor-phones.update');
       Route::delete('vendor-phones/{id}',[VendorPhoneController::class,'destroy'])->name('vendor-phones.destroy');
       //vendor-phones route end===================================================

       //vendor-peoples route start===================================================
       Route::get('vendor-peoples/create/{vendor_id}', [VendorPeopleController::class,'create'])->name('vendor-peoples.create');
       Route::post('vendor-peoples/store', [VendorPeopleController::class,'store'])->name('vendor-peoples.store');
       Route::get('vendor-peoples/{vendor_id}', [VendorPeopleController::class,'index'])->name('vendor-peoples.index');
       Route::get('vendor-peoples/{id}/edit', [VendorPeopleController::class,'edit'])->name('vendor-peoples.edit');
       Route::put('vendor-peoples/{id}',[VendorPeopleController::class,'update'])->name('vendor-peoples.update');
       Route::delete('vendor-peoples/{id}',[VendorPeopleController::class,'destroy'])->name('vendor-peoples.destroy');
       //vendor-peoples route end===================================================
    });
});
