<?php

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

/* Products */
Route::get("/products", "ProductController@index");
Route::post("/products", "ProductController@store");
Route::put("/products/{product}", "ProductController@update");
Route::delete("/products/{product}", "ProductController@destroy");

/* Categories */
Route::get("/categories", "CategoryController@index");
Route::post("/categories", "CategoryController@store");
Route::delete("/categories/{category}", "CategoryController@destroy");
