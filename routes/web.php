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
Route::get('sale/{id}','SaleController@sale');

Route::get('/', 'Auth\LoginController@login')->name('index');
Route::post('search','SaleController@search')->name('search');
Route::post('bills','SaleController@bill')->name('bills');
Route::get('list','SaleController@list')->name('list');



Route::group(['middleware'=>'auth'],function(){


	Route::resource('/category','CategoryController'); 
	Route::resource('/brand','BrandController'); 
	Route::resource('/product','ProductController'); 
	Route::resource('/shop','ShopController'); 
	Route::resource('/user','UserController'); 
	Route::resource('/sale','SaleController'); 
	Route::resource('/report','ReportController'); 
	Route::resource('/dashboard','DashboardController'); 

	// instock
	Route::get('/instock/create/{id}','StockController@instock_create')->name('instock.create'); 
	Route::post('/instock/store','StockController@instock_update')->name('instock.store');

	Route::get('/instock/edit/{id}','StockController@instock_edit')->name('instock.edit'); 
	Route::put('/instock/update/{id}','StockController@instock_update')->name('instock.update');

	// debit
	Route::get('/debit/index','StockController@debit_list')->name('debit.index'); 
	Route::get('/debit/create','StockController@debit_create')->name('debit.create'); 
	Route::post('/debit/store','StockController@debit_store')->name('debit.store'); 
	Route::delete('/debit/destroy/{id}','StockController@debit_destroy')->name('debit.destroy');

	// return
	Route::get('/return/index','StockController@return_list')->name('return.index'); 
	Route::get('/return/create','StockController@return_create')->name('return.create'); 
	Route::post('/return/store','StockController@return_store')->name('return.store'); 
	Route::delete('/return/destroy/{id}','StockController@return_destroy')->name('return.destroy');

	
	Route::get('category/{id}','CategoryController@category')->name('category');


});

// Auth::routes(); 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



