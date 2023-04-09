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
    Route::get('/administrator/website_manager/slider', [App\Http\Controllers\AdministratorController::class, 'website_manager_slider']);
    Route::get('/administrator/website_manager/features', [App\Http\Controllers\AdministratorController::class, 'website_manager_features']);

    Route::get('/administrator/products/category', [App\Http\Controllers\AdministratorController::class, 'products_category']);
    Route::get('/administrator/products/sub_category', [App\Http\Controllers\AdministratorController::class, 'products_sub_category']);
    Route::get('/administrator/products/product_group', [App\Http\Controllers\AdministratorController::class, 'products_product_group']);
    Route::get('/administrator/products/products/{id}', [App\Http\Controllers\AdministratorController::class, 'products_products']);

    /* Settings Routes */
    Route::get('/administrator/settings', [App\Http\Controllers\SettingController::class, 'settings']);
    Route::post('/administrator/get_setting', [App\Http\Controllers\SettingController::class, 'get_setting']);
    Route::post('/administrator/save_setting', [App\Http\Controllers\SettingController::class, 'save_setting']);
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