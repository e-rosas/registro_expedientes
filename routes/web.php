<?php

use Illuminate\Support\Facades\Route as Route;

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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('expedientes', 'ExpedienteController');
    Route::get('lista', 'ExpedienteController@list')->name('expedientes.list');
    Route::post('expedientes/destruir', 'ExpedienteController@destroyList')->name('expedientes.destruir');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('calls', 'CallController@index')->name('calls.index');
    Route::post('calls/add', 'CallController@store')->name('calls.store');
    Route::post('calls/find', 'CallController@find')->name('calls.find');
    Route::patch('calls/update', 'CallController@update')->name('calls.update');
    Route::delete('calls/destroy', 'CallController@delete')->name('calls.destroy');
});