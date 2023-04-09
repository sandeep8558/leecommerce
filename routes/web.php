<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WebsiteController::class, 'welcome']);

Route::get('/notify/{title}/{msg}', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->middleware("administrator");

Auth::routes(['register' => true]);

/* Framework Routes */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/crud', 'App\Http\Controllers\CrudController');
Route::post('/crud/showall', [App\Http\Controllers\CrudController::class, 'showall']);


/* Auth Routes */
Route::group(['middleware'=>['auth']], function(){
});


/* Administrator Routes */
Route::group(['middleware'=>['auth', 'administrator']], function(){
    Route::get('/administrator', [App\Http\Controllers\AdministratorController::class, 'index'])->name("administrator");
});


/* Web-Admin Routes */
Route::group(['middleware'=>['auth', 'webadmin']], function(){
    Route::get('/webadmin', [App\Http\Controllers\WebAdminController::class, 'index'])->name("webadmin");
});


/* Store Manager Routes */
Route::group(['middleware'=>['auth', 'storemanager']], function(){
    Route::get('/storemanager', [App\Http\Controllers\StoreManagerController::class, 'index'])->name("storemanager");
});


/* Customer Routes */
Route::group(['middleware'=>['auth', 'customer']], function(){
    Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name("customer");
});