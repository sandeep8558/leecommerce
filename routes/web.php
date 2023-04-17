<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Category;

/* Website Route */
Route::get('/', [App\Http\Controllers\WebsiteController::class, 'welcome']);
Route::get('/category/{id}', [App\Http\Controllers\WebsiteController::class, 'category']);
Route::get('/category/{id}/sub_category/{sid}', [App\Http\Controllers\WebsiteController::class, 'sub_category']);
Route::get('/product/{id}/{pid}', [App\Http\Controllers\WebsiteController::class, 'product']);
Route::get('/wishlist', [App\Http\Controllers\WishListController::class, 'index']);
Route::post('/wishlist/add', [App\Http\Controllers\WishListController::class, 'add']);
Route::get('/search', [App\Http\Controllers\WebsiteController::class, 'search']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add']);
Route::get('/cart/get_cart', [App\Http\Controllers\CartController::class, 'get_cart']);
Route::get('/cart/delete_cart_item/{id}', [App\Http\Controllers\CartController::class, 'delete_cart_item']);
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout']);
Route::post('/checkout/save_address', [App\Http\Controllers\CheckoutController::class, 'save_address']);
Route::post('/checkout/set_default_address', [App\Http\Controllers\CheckoutController::class, 'set_default_address']);
Route::post('/checkout/delete_address', [App\Http\Controllers\CheckoutController::class, 'delete_address']);
Route::post('/checkout/pay', [App\Http\Controllers\CheckoutController::class, 'pay']);
Route::post('/checkout/update_order', [App\Http\Controllers\CheckoutController::class, 'update_order']);
Route::post('/checkout/check/coupon', [App\Http\Controllers\CheckoutController::class, 'check_coupon']);


Route::get('/about', [App\Http\Controllers\WebsiteController::class, 'about']);
Route::get('/contact', [App\Http\Controllers\WebsiteController::class, 'contact']);
Route::get('/tnc', [App\Http\Controllers\WebsiteController::class, 'tnc']);
Route::get('/rnr', [App\Http\Controllers\WebsiteController::class, 'rnr']);
Route::get('/privacy', [App\Http\Controllers\WebsiteController::class, 'privacy']);



Route::get('/notify/{title}/{msg}', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->middleware("administrator");

Auth::routes(['register' => true]);

/* Framework Routes */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/crud', 'App\Http\Controllers\CrudController');
Route::post('/crud/showall', [App\Http\Controllers\CrudController::class, 'showall']);



/* Auth Routes */
Route::group(['middleware'=>['auth']], function(){
});


/* Common Auth Routes */
Route::group(['middleware'=>['auth']], function(){
    Route::get('/common/print/product/{id}', [App\Http\Controllers\CommonController::class, 'product']);
});


/* Administrator Routes */
Route::group(['middleware'=>['auth', 'administrator']], function(){
    Route::get('/administrator', [App\Http\Controllers\AdministratorController::class, 'index'])->name("administrator");
    Route::get('/administrator/website_manager/slider', [App\Http\Controllers\AdministratorController::class, 'website_manager_slider']);
    Route::get('/administrator/website_manager/features', [App\Http\Controllers\AdministratorController::class, 'website_manager_features']);
    Route::get('/administrator/website_manager/pages', [App\Http\Controllers\AdministratorController::class, 'website_manager_pages']);
    Route::get('/administrator/website_manager/content', [App\Http\Controllers\AdministratorController::class, 'website_manager_content']);
    Route::get('/administrator/products/category', [App\Http\Controllers\AdministratorController::class, 'products_category']);
    Route::get('/administrator/products/sub_category', [App\Http\Controllers\AdministratorController::class, 'products_sub_category']);
    Route::get('/administrator/products/product_group', [App\Http\Controllers\AdministratorController::class, 'products_product_group']);
    Route::get('/administrator/products/products/{id}', [App\Http\Controllers\AdministratorController::class, 'products_products']);
    Route::get('/administrator/purchase', [App\Http\Controllers\AdministratorController::class, 'purchase']);
    Route::get('/administrator/offers', [App\Http\Controllers\AdministratorController::class, 'offers']);
    Route::get('/administrator/user_manager', [App\Http\Controllers\AdministratorController::class, 'user_manager']);
    Route::get('/administrator/user_manager/roles/{id}', [App\Http\Controllers\AdministratorController::class, 'user_manager_roles']);

    Route::get('/administrator/orders/pending', [App\Http\Controllers\AdministratorController::class, 'pending']);
    Route::get('/administrator/orders/accepted', [App\Http\Controllers\AdministratorController::class, 'accepted']);
    Route::get('/administrator/orders/packed', [App\Http\Controllers\AdministratorController::class, 'packed']);
    Route::get('/administrator/orders/shipped', [App\Http\Controllers\AdministratorController::class, 'shipped']);
    Route::get('/administrator/orders/delivered', [App\Http\Controllers\AdministratorController::class, 'delivered']);

    Route::get('/administrator/order/{id}/forward/{what}', [App\Http\Controllers\AdministratorController::class, 'forward']);
    Route::get('/administrator/order/{id}/reverse/{what}', [App\Http\Controllers\AdministratorController::class, 'reverse']);

    Route::get('/administrator/print/{id}/label', [App\Http\Controllers\AdministratorController::class, 'label']);
    Route::get('/administrator/print/{id}/receipt', [App\Http\Controllers\AdministratorController::class, 'receipt']);

    /* Settings Routes */
    Route::get('/administrator/settings', [App\Http\Controllers\SettingController::class, 'settings']);
    Route::post('/administrator/get_setting', [App\Http\Controllers\SettingController::class, 'get_setting']);
    Route::post('/administrator/save_setting', [App\Http\Controllers\SettingController::class, 'save_setting']);

    Route::get('/administrator/reports/purchase', [App\Http\Controllers\ReportsController::class, 'purchase']);
    Route::get('/administrator/reports/sale', [App\Http\Controllers\ReportsController::class, 'sale']);
    Route::get('/administrator/reports/invoices', [App\Http\Controllers\ReportsController::class, 'invoices']);

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
    Route::get('/order/cancel/{id}', [App\Http\Controllers\CustomerController::class, 'cancel']);
});

View::composer(['*'], function($view){

    $facebook = Setting::where('key', 'Facebook')->exists() ? Setting::where('key', 'Facebook')->first()->val : null;
    $instagram = Setting::where('key', 'Instagram')->exists() ? Setting::where('key', 'Instagram')->first()->val : null;
    $youtube = Setting::where('key', 'Youtube')->exists() ? Setting::where('key', 'Youtube')->first()->val : null;
    $whatsapp = Setting::where('key', 'WhatsApp')->exists() ? Setting::where('key', 'WhatsApp')->first()->val : null;

    $address = Setting::where('key', 'Address')->exists() ? Setting::where('key', 'Address')->first()->val : null;
    $support_email = Setting::where('key', 'Support Email')->exists() ? Setting::where('key', 'Support Email')->first()->val : null;
    $support_mobile = Setting::where('key', 'Support Mobile')->exists() ? Setting::where('key', 'Support Mobile')->first()->val : null;
    $app_name = Setting::where('key', 'App Name')->exists() ? Setting::where('key', 'App Name')->first()->val : null;
    $show_app_name = Setting::where('key', 'Show App Name')->exists() ? Setting::where('key', 'Show App Name')->first()->val : null;
    $logo = Setting::where('key', 'Logo')->exists() ? Setting::where('key', 'Logo')->first()->val : null;
    $show_logo = Setting::where('key', 'Show Logo')->exists() ? Setting::where('key', 'Show Logo')->first()->val : null;
    $tag_line = Setting::where('key', 'Tag Line')->exists() ? Setting::where('key', 'Tag Line')->first()->val : null;
    $show_tag_line = Setting::where('key', 'Show Tag Line')->exists() ? Setting::where('key', 'Show Tag Line')->first()->val : null;
    $cats = Category::where('display', 'Show')->get();
    
    $view
    ->with('cats', $cats)
    ->with('facebook', $facebook)->with('instagram', $instagram)->with('youtube', $youtube)->with('whatsapp', $whatsapp)
    ->with('address', $address)->with('support_email', $support_email)->with('support_mobile', $support_mobile)
    ->with('app_name', $app_name)->with('logo', $logo)->with('tag_line', $tag_line)
    ->with('show_app_name', $show_app_name)->with('show_logo', $show_logo)->with('show_tag_line', $show_tag_line);
});