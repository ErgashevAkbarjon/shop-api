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

/* Products */
Route::get("/products", "ProductController@index");
Route::post("/products", "ProductController@store");
Route::put("/products/{product}", "ProductController@update");
Route::delete("/products/{product}", "ProductController@destroy");

/* Categories */
Route::get("/categories", "CategoryController@index");
Route::post("/categories", "CategoryController@store");
Route::delete("/categories/{category}", "CategoryController@store");
