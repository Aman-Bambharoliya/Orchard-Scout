<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\InspectionQuestionController;
use App\Http\Controllers\api\v1\CropCommodityController;
use App\Http\Controllers\api\v1\CustomerController;
use App\Http\Controllers\api\v1\LoginController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [LoginController::class,'login']);
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('questions/{commodity_id}', [InspectionQuestionController::class, 'question']);
        Route::get('crop-commodities', [CropCommodityController::class, 'index']);
        Route::get('customers', [CustomerController::class, 'getAllCustomers']);
        Route::get('customer/addresses/{customer_id}', [CustomerController::class, 'getAddressByCustomerId']);
        Route::post('inspection-report', [InspectionQuestionController::class, 'saveInspectionReport']);
    });
});