<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
/*

Route::get('/', function () {
    dd(config('app.url'));
});
*/
Route::get('menu', 'MenuController@daySelection')->name('menu');

Route::domain('admin.' . config('app.url'))->group(function() {

	Route::get('/login', [AuthenticatedSessionController::class, 'create'])
	                ->middleware('guest')
	                ->name('login');

	Route::post('/login', [AuthenticatedSessionController::class, 'store'])
	                ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
});

Route::domain('admin.' . config('app.url'))->middleware('auth')->group(function() {

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

Route::domain('guest.' . config('app.url'))->group(function() {
	Route::get('/login', 'GuestLoginController@show')
	                ->middleware('guest')
	                ->name('guest_login');

	Route::post('/login', 'GuestLoginController@authenticate')
	                ->middleware('guest');

});

Route::domain('guest.' . config('app.url'))->middleware('auth:guest_users')->group(function() {
	Route::get('/', function () {
	    return 'asf';
	})->name('guest_dashboard');

	Route::get('/user_completion', 'GuestController@userCompletion')->name('guest_user_completion');

});



//require __DIR__.'/auth.php';
