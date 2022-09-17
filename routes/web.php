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

Auth::routes();

// routes per gli admin 
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function() {

    // specifico il path della home che usa index() per gli admin
    Route::get('/', 'HomeController@index')->name('home');
});

// specifico che per ogni path scritto male o se un utento non admin cerca 
// di accedere ai path degli admin viene rimandato alla home del guest
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');