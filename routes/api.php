<?php


use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\Auth\AuthController@login');
    Route::post('signup', 'Api\Auth\AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\Auth\AuthController@logout');
        Route::get('user', 'Api\Auth\AuthController@user');

        Route::apiResource('users', 'Api\UserController');
    });



});


Route::apiResource('brand', 'Api\BrandController');
Route::apiResource('category', 'Api\CategoryController');
Route::apiResource('product', 'Api\ProductController');

Route::get('brand-by-slug/{slug}', 'Api\BrandController@brand_by_slug');
Route::get('category-by-slug/{slug}', 'Api\CategoryController@bySlug');
Route::get('product-by-slug/{slug}', 'Api\ProductController@bySlug');
Route::get('search', 'Api\SearchController@search');
// Route::get('import', 'Api\ImportImagesController@import');