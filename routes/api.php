<?php

use Illuminate\Http\Request;

use App\Http\Controllers\importController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspecaoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\authController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\apiController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/qualidade/show/{id?}', [apiController::class, 'show']);

Route::get('/qualidade/create/{id}', [apiController::class, 'create']);

Route::get('/qualidade/edit/{id}', [apiController::class, 'update']);

Route::get('/qualidade/destroy/{id}', [apiController::class, 'destroy']);

