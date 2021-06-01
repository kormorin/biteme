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


Route::group(['middleware' => 'auth'], function() {
	Route::get('/', function () {
	    return redirect(route('menu'));
	})->name('dashboard');

	//profile
	Route::get('profile', 'ProfileController@show')->name('profile');
	Route::post('update_profile', 'ProfileController@updateProfile')->name('update_profile');
	Route::post('update_password', 'ProfileController@updatePassword')->name('update_password');

	Route::get('menu', 'MenuController@daySelection')->name('menu');
	Route::get('menu/{day}', 'MenuController@menuCreation')->name('menu_creation');

	Route::get('orders', 'OrderController@show')->name('orders');
});


require __DIR__.'/auth.php';
