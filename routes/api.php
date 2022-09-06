<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\RateListController;
use App\Http\Controllers\CorporateRateListController;

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


Route::controller(UserController::class)->group(function () {
    // Signup and Login
    Route::post('/admin/signup', 'createAdmin');
    Route::post('/image/{id}', 'image');
    Route::post('/signup', 'create');
    Route::get('/user/{id}', 'show');

    Route::post('/login', 'login')->name('login');
    // Forgot Password
    Route::post('/password/forgot', 'sendResetLink');
    // after clicking button in mail
    Route::get('/password/forgot/form/{token}', 'resetForm')->name('passwordResetForm');
    Route::post('/password/reset/{token}', 'resetPassword')->name('rPassword');
    Route::get('/resetSuccess', 'resetSuccess')->name('resetSuccess');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/admin/user', 'index');
        Route::put('/user/{id}/update', 'update');
        Route::delete('/admin/user/{id}/delete', 'destroy');
        Route::get('/profile', 'profile');
        Route::put('/profile/update', 'updateProfile');
        Route::delete('/profile/delete', 'profileDelete');
        Route::post('/admin/deleteAllUser', 'deleteAllUser');
        Route::post('/profile/change-password', 'changepassword');
    });
});



Route::controller(OrderController::class)->group(function (){
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/order', 'create');
    Route::get('/{user_id}/order', 'show');
    Route::get('/list',  'index');
    Route::delete('/order/{id}/delete/}', 'destroy');
    Route::put('/order/{id}','update');

});
});


Route::controller(SettingController::class)->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Setting Section
        Route::post('/about', 'create');
        Route::get('/about/show','index');
        Route::put('/about/{id}/update',  'update');
    });
});

Route::controller(CategoryController::class)->group( function(){
    Route::post('/category/add','create');
    Route::get('/category/list','index');
    Route::get('/category/show','show');
    Route::get('/category/{id}','subcategory');
    Route::delete('/cat/delete/{id}','destroy');
    Route::put('/category/{id}/update', 'editCategory');
    Route::put('/subCategory/{id}/update', 'editSubCategory');

    Route::group(['middleware' => 'auth:sanctum'], function () {

    });
});


// Banner Section
Route::controller(BannerController::class)->group(function () {
    Route::post('/admin/banner/add', 'create');
    Route::get('/banner/list', 'index');
    Route::get('/banner/{id}', 'show');


    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::put('/admin/banner/{id}/update', 'update');
        Route::delete('/admin/banner/{id}/delete', 'destroy');
    });
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/product/show', 'index');
    Route::get('/product/{product:id}/data', 'show');
    Route::post('/product/add', 'create');
    Route::get('/cart', 'cart');
    Route::get('/cart/{id}', 'addToCart');

    Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/subCategory/{category:id}', 'categories')->name('categories');
    Route::put('/product/{id}/update', 'update');
    Route::delete('/product/{id}/delete', 'destroy');
    });
});

Route::controller(AttributeController::class)->group(function () {

    Route::post('/attribute/add', 'create');
    Route::get('/attribute/list', 'index');
    Route::get('/attribute/{id}', 'show');
    Route::delete('/attribute/{id}/delete', 'destroy');
    Route::put('/attribute/{id}/update', 'update');

});

Route::controller(CorporateRateListController::class)->group( function(){
    Route::post('/corporate/price','create');
    Route::GET('/corporate/{id}/','show');
    Route::get('/corporate/list','index');
    Route::put('/corporate/update/{id}','update');
    Route::delete('/corporate/{id}','destroy');
});

Route::controller(RateListController::class)->group( function(){
    Route::post('/price','create');
    Route::get('/price/{id}','show');
    Route::get('/price/list','index');
    Route::put('/price/update/{id}','update');
    Route::delete('/price/{id}','destroy');
});
