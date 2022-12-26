<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\InsuranceController;
use Illuminate\Support\Facades\Route;

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

Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);

Route::middleware(['auth:sanctum'])->group(function (){
   Route::get('insurances' , [InsuranceController::class , 'index']);
   Route::post('insurances' , [InsuranceController::class , 'store']);
});

Route::get('bot' , [BotController::class , 'init']);
Route::get('bot/add' , [BotController::class , 'index']);
Route::get('bot/delete' , [BotController::class , 'delete']);
