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

Route::post('/management/{id}', [App\Http\Controllers\ManagmentController::class, 'destroy'])->name('managment.destroy');
Route::get('/management/create/{email}/{token}', [App\Http\Controllers\ManagmentController::class, 'create'])->name('managment.create');
Route::put('/information/edit', [App\Http\Controllers\InformationController::class, 'update'])->name('information.edit');

Route::post('/financial', [App\Http\Controllers\FinancialController::class, 'index'])->name('financial.index');
Route::post('/financial/create', [App\Http\Controllers\FinancialController::class, 'store'])->name('financial.store');
Route::put('/financial/update/{id}', [App\Http\Controllers\FinancialController::class, 'update'])->name('financial.update');

Route::post('/bankinformation', [App\Http\Controllers\BankinformationController::class, 'index'])->name('bankinformation.index');
Route::post('/bankinformation/create', [App\Http\Controllers\BankinformationController::class, 'store'])->name('bankinformation.store');
Route::put('/bankinformation/update/{id}', [App\Http\Controllers\BankinformationController::class, 'update'])->name('bankinformation.update');

Route::post('/certification', [App\Http\Controllers\CertificationController::class, 'index'])->name('certification.index');
Route::post('/certification/create', [App\Http\Controllers\CertificationController::class, 'store'])->name('certification.store');
Route::put('/certification/update/{id}', [App\Http\Controllers\CertificationController::class, 'update'])->name('certification.update');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas accesibles para SuperAdmin y Admin
Route::group(['middleware' => ['role:SuperAdmin|Admin']], function () {  
  Route::resource('clients', App\Http\Controllers\ClientsController::class);
  Route::resource('companies', App\Http\Controllers\CompanyController::class);
  
  Route::resource('users', App\Http\Controllers\UsersController::class);
  Route::get('/users/{rol}/type', [App\Http\Controllers\UsersController::class, 'getRol'])->name('users.rol');
  Route::post('/users/search', [App\Http\Controllers\UsersController::class, 'search'])->name('users.search');

  Route::get('/credit/{user}/approve', [App\Http\Controllers\CreditController::class, 'approve'])->name('credit.approve');
  Route::get('/credit/{user}/deny', [App\Http\Controllers\CreditController::class, 'deny'])->name('credit.deny');
  Route::get('/credit/{user}/askmore', [App\Http\Controllers\CreditController::class, 'askmore'])->name('credit.askmore');
  Route::get('/credit/{user}/edit', [App\Http\Controllers\CreditController::class, 'edit'])->name('credit.edit');
  Route::post('/credit/approve', [App\Http\Controllers\CreditController::class, 'storeapprove'])->name('credit.storeapprove');
  Route::post('/credit/deny', [App\Http\Controllers\CreditController::class, 'storedeny'])->name('credit.storedeny');
  Route::post('/credit/askmore', [App\Http\Controllers\CreditController::class, 'storeaskmore'])->name('credit.storeaskmore'); 
  Route::post('/credit/update', [App\Http\Controllers\CreditController::class, 'update'])->name('credit.update');
  Route::get('/documents/{document}/approve', [App\Http\Controllers\DocumentsController::class, 'approve'])->name('documents.approve');
  Route::post('/documents/approve', [App\Http\Controllers\DocumentsController::class, 'storeapprove'])->name('documents.storeapprove'); 
  Route::get('/documents/{document}/reject', [App\Http\Controllers\DocumentsController::class, 'reject'])->name('documents.reject'); 
  Route::post('/documents/reject', [App\Http\Controllers\DocumentsController::class, 'storereject'])->name('documents.storereject'); 
});

Route::group(['middleware' => ['role:Client']], function () {  
  Route::resource('financing', App\Http\Controllers\FinancingController::class);  
});

Route::get('/notification/{type}', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification.index');
Route::get('/notification/view/{type}/{id}', [App\Http\Controllers\NotificationController::class, 'show'])->name('notification.show');
Route::post('/notification/store', [App\Http\Controllers\NotificationController::class, 'store'])->name('notification.store');  

Route::resource('documents', App\Http\Controllers\DocumentsController::class);  
Route::post('/documents/search', [App\Http\Controllers\DocumentsController::class, 'search'])->name('documents.search');