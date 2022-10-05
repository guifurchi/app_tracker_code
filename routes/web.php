<?php

use App\Http\Controllers\importController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspecaoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\authController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\apiController;

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

Route::get('/', [indexController::class, 'index']);
Route::get('/mainPage', [indexController::class, 'mainPage']);
Route::get('/QRcode', [apiController::class, 'index']);

//rotas de autenticação e login
Route::post('/login', [authController::class, 'auth']);
Route::get('/logout', [authController::class, 'logout']);

//rotas do CRUD de inspeção
Route::get('/inspecao', [InspecaoController::class, 'index']);
Route::post('/inspecao/create', [InspecaoController::class, 'create']);
Route::put('/inspecao/{id}/edit', [InspecaoController::class, 'update']);
Route::get('/inspecao/{id}/delete', [InspecaoController::class, 'destroy']);

//rotas do CRUD de usuário
Route::get('/cadastrar', [UserController::class, 'index']);
Route::post('/cadastrar/create', [UserController::class, 'create']);
Route::post('/cadastrar/{id}/edit', [UserController::class, 'update']);
Route::get('/cadastrar/{id}/delete', [UserController::class, 'destroy']);

//rotas para alterar a senha
Route::get('/password/{id}', [UserController::class, 'editPassword']);
Route::post('/password/{id}/edit', [UserController::class, 'validPassword']);

//rotas de consulta de inspeções
Route::get('/inspectQuery', [InspecaoController::class, 'inspectQuery']);
Route::get('/showDetails/{id}', [InspecaoController::class, 'showDetails']);
Route::get('/inspecao/{id}/edit/', [InspecaoController::class, 'edit']);

//rotas de consultas de usuários
Route::get('/usuarios', [UserController::class, 'usersQuery']);
Route::get('/showUser/{id}', [UserController::class, 'showUser']);
Route::get('/cadastrar/{id}/edit', [UserController::class, 'edit']);

//rotas para tratar dados
Route::get('/import', [importController::class, 'index']);