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

/*
|--------------------------------------------------------------------------
| Web Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {
	Route::controller(AuthController::class)->group(function () {
	    Route::get('register', 		'showRegisterForm')->name('web.showRegisterForm');
	    Route::post('register', 	'register'		  )->name('web.registger'  	    );
	    Route::post('check_email', 	'checkEmail'	  )->name('web.checkEmail'  	);
	    Route::get('login', 		'showLoginForm'	  )->name('web.showLoginForm'	);
	    Route::post('login', 		'login'			  )->name('web.login'  	   		);
	});
}); 

/*
|--------------------------------------------------------------------------
| Web Public Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {
	/*
	|--------------------------------------------------------------------------
	| Home Routes
	|--------------------------------------------------------------------------
	*/
	Route::get('/', 'HomeController@index')->name('home');

	/*
	|--------------------------------------------------------------------------
	| NewsLetter Routes
	|--------------------------------------------------------------------------
	*/
	Route::post('news-letter/store', 'NewsletterController@store');
});

/*
|--------------------------------------------------------------------------
| Web Private Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Web','middleware' => ['web','customer']], function () {
	/*
	|--------------------------------------------------------------------------
	| Customer Routes
	|--------------------------------------------------------------------------
	*/
	Route::controller(CustomerController::class)->prefix('customer')->group(function () {
		Route::post('logout', 		'logout'	)->name('customer.logout'	 );
		Route::get('profile',		'profile'	)->name('customer.profile'	 );
		Route::post('update',		'update' 	)->name('customer.update' 	 );
	});
});
