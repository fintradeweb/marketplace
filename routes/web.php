<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/information', [App\Http\Controllers\InformationController::class, 'index']);
Route::post('/information/create', [App\Http\Controllers\InformationController::class, 'store'])->name('information.create');
Route::post('/management/create', [App\Http\Controllers\ManagmentController::class, 'store'])->name('managment.create');
Route::put('/information/edit', [App\Http\Controllers\InformationController::class, 'update'])->name('information.edit');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:SuperAdmin']], function () {
  //rutas accesibles solo para clientes
  Route::resource('clients', App\Http\Controllers\ClientsController::class);
});

Route::group(['middleware' => ['role:Admin']], function () {
  //rutas accesibles solo para clientes
  //Route::resource('clients', App\Http\Controllers\ClientsController::class);
});