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
Route::post('/management/create', [App\Http\Controllers\ManagmentController::class, 'store'])->name('managment.store');
Route::post('/financial/create', [App\Http\Controllers\FinancialController::class, 'store'])->name('financial.store');
Route::post('/management/{id}', [App\Http\Controllers\ManagmentController::class, 'destroy'])->name('managment.destroy');
Route::get('/management/create/{email}/{token}', [App\Http\Controllers\ManagmentController::class, 'create'])->name('managment.create');
Route::put('/information/edit', [App\Http\Controllers\InformationController::class, 'update'])->name('information.edit');

Route::post('/financial', [App\Http\Controllers\FinancialController::class, 'index'])->name('financial.index');
Route::post('/financial/create', [App\Http\Controllers\FinancialController::class, 'store'])->name('financial.store');
Route::put('/financial/update/{id}', [App\Http\Controllers\FinancialController::class, 'update'])->name('financial.update');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:SuperAdmin']], function () {
  //rutas accesibles solo para clientes
  Route::resource('clients', App\Http\Controllers\ClientsController::class);
});

Route::group(['middleware' => ['role:Admin']], function () {
  //rutas accesibles solo para clientes
  Route::resource('clients', App\Http\Controllers\ClientsController::class);
});

