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
	Route::post('update_profile', 'ProfileController@updateProfile')->name('update_profile');//
	Route::post('update_password', 'ProfileController@updatePassword')->name('update_password');
	Route::post('create_new_admin', 'ProfileController@createNewAdmin')->name('create_new_admin');

	Route::get('menu', 'MenuController@daySelection')->name('menu');
	Route::get('menu/{day}', 'MenuController@menuCreation')->name('menu_creation');
	Route::post('delete_menu', 'MenuController@destroy')->name('delete_menu');

	Route::get('orders', 'OrderController@daySelection')->name('orders');
	Route::get('orders/{day}', 'OrderController@reviewOrders');

});

Route::domain('guest.' . config('app.url'))->group(function() {
	Route::get('/login', 'GuestLoginController@show')
	                ->middleware('guest')
	                ->name('guest_login');

	Route::post('/login', 'GuestLoginController@authenticate')
	                ->middleware('guest');

	Route::post('/logout', 'GuestLoginController@logout')
                ->middleware('auth')
                ->name('guest.logout');
});

Route::domain('guest.' . config('app.url'))->middleware('auth:guest_users')->group(function() {
	Route::get('/', 'GuestProfileController@index')->name('guest.profile');
	Route::post('update_profile', 'GuestProfileController@updateProfile')->name('guest.update_profile');
	Route::post('update_password', 'GuestProfileController@updatePassword')->name('guest.update_password');

	Route::get('place_order', 'PlaceOrderController@daySelection')->name('guest.place_order');
	Route::get('place_order/{day}', 'PlaceOrderController@chooseFromMenu');
	Route::post('place_order/{day}', 'PlaceOrderController@placeOrder');

	Route::get('department_list', 'OrdersForDepartmentController@daySelection')->name('guest.department_list');
	Route::get('department_list/{day}', 'OrdersForDepartmentController@show');
//	Route::post('update_password', 'GuestProfileController@updatePassword')->name('guest.place_order');
//	Route::get('/', 'GuestController@userCompletion')->name('guest_user_completion');

});



require __DIR__.'/auth.php';
