<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ItemImagesController;
use App\Http\Controllers\SubCategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| He    re is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class , 'register']);
Route::post('/login', [AuthController::class , 'login']);
Route::get('/item-by-categoryId/{id}', [ItemController::class, 'getItemByCategoryId']);

Route::resource('/category', CategoryController::class)
->missing(function (Request $request){
    return BaseController::sendError("No Record Found",[],404) ;
});
Route::resource('/item', ItemController::class)
->missing(function (Request $request){
return BaseController::sendError("No Record Found",[],404) ;
});

Route::resource('/subCategory', SubCategoryController::class)
    ->missing(function (Request $request){
        return BaseController::sendError("No Record Found",[],404) ;
    });



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::resource('/customer', CustomerController::class)
        ->missing(function (Request $request){
          return BaseController::sendError("No Record Found",[],404) ;
        });
    Route::resource('/address', AddressController::class)
        ->missing(function (Request $request){
            return BaseController::sendError("No Record Found",[],404) ;
        });
    Route::resource('/expert', ExpertController::class)
        ->missing(function (Request $request){
            return BaseController::sendError("No Record Found",[],404) ;
        });
    Route::resource('/itemimage', ItemImagesController::class)
        ->missing(function (Request $request){
            return BaseController::sendError("No Record Found",[],404) ;
        });
});
