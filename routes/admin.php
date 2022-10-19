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
define('PAGINATION_COUNT',10);
Route::group(['middleware'=>'auth:admin','namespace' =>'App\Http\Controllers\Admin'],function(){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    ######################################Begin Languages Route####################################
    Route::group(['prefix'=>'languages'],function(){
        Route::get('/','LanguagesController@index')->name('admin.languages');
        Route::get('create','LanguagesController@create')->name('admin.languages.create');
        Route::post('store','LanguagesController@store')->name('admin.languages.store');
        Route::get('edit/{id}','LanguagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}','LanguagesController@update')->name('admin.languages.update');
    });
    ######################################End Languages Route####################################

});

Auth::routes();

Route::group(['middleware'=>'guest:admin','namespace' =>'App\Http\Controllers\Admin'],function(){
Route::get('/login', 'LoginController@getLogin')->name('get.admin.login');
Route::post('/login', 'LoginController@login')->name('admin.login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

