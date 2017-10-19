<?php

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

Route::get('/', function () {
    return redirect('home');
});

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/campaigns', 'CampaignController@index');
// Route::get('/campaigns/{id}', 'CampaignController@show');
// Route::get('/campaigns/create', 'CampaignController@create');
Route::get('/campaigns/{id}/edit', 'CampaignController@edit');

Route::post('/campaigns/{id}/update', 'CampaignController@update');
Route::post('/campaigns/{id}/remove/store', 'CampaignController@removeStore');


Route::get('/stores', 'StoreController@index')->name('store-list');;;
Route::get('/stores/{id}/edit', 'StoreController@edit');
Route::get('/stores/create', 'StoreController@create');
Route::put('/stores/{id}', 'StoreController@update')->name('store.update');
Route::post('/stores', 'StoreController@store')->name('store.new');


// Route::get('/campaign/')

