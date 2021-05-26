<?php

use Illuminate\Http\Request;
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

Route::namespace('API')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('reset-password-request', 'AuthController@resetPasswordRequest');
        Route::post('reset-password', 'AuthController@resetPassword');

        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('profile', 'AuthController@profile');
            Route::post('change-password', 'AuthController@changePassword');
            Route::get('logout','AuthController@logout');
            Route::get('/fetch-sales' , 'SoldController@fetchAllSales');
            Route::post('/filter-sales' , 'SoldController@filterSales');
        });
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'scope:admin'], function () {
            Route::resource('/categories' , 'CategoryController');
            Route::resource('/sub-categories' , 'SubCategoryController');
            Route::resource('/products' , 'ProductController');
            Route::resource('/brands' , 'BrandController');
            Route::resource('/cart' , 'CartController');
            Route::post('/sell-product' , 'CartController@sellProduct');
            Route::get('/get-sub-categories/{id}' , 'ProductController@getSubCategories');
            Route::get('/product/search' , 'ProductController@getSearchResult');
            Route::get('/get-dashboard' , 'AdminController@getDashboard');
        });
    });

    Route::group(['prefix' => 'manager', 'middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'scope:manager'], function () {
            Route::get('get-accepted-questions' , 'QuestionController@getAcceptedQuestions');
        });
    });

    Route::group(['prefix' => 'employee', 'middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'scope:employee'], function () {
            Route::get('get-accepted-questions' , 'QuestionController@getAcceptedQuestions');
        });
    });

    Route::post('ask-question' , 'QuestionController@store');
});
