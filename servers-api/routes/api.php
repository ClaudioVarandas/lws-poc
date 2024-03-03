<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    });*/

Route::get('/',function (){
    return new JsonResponse();
});
Route::get('/servers','App\Controller\ServersController@index');
Route::get('/options/locations','App\Controller\OptionLocationController@index');
Route::get('/options/hdd-type','App\Controller\OptionHddTypeController@index');
Route::get('/options/ram-type','App\Controller\OptionRamTypeController@index');
Route::get('/options/storage','App\Controller\OptionStorageController@index');
