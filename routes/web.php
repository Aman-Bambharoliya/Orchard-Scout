<?php

use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemoController;
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
    });
});
