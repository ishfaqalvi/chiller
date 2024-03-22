<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Login Route
|--------------------------------------------------------------------------
*/
Route::controller(LoginController::class)->as('admin.')->group(function () {
    Route::get('login', 	'showLoginForm'	)->name('showLoginForm'	);
    Route::post('login', 	'login'			)->name('login'		 	);
    Route::post('logout', 	'logout'		)->name('logout'		);   
});

/*
|--------------------------------------------------------------------------
| Forgot Password Route
|--------------------------------------------------------------------------
*/
Route::controller(ForgotPasswordController::class)->as('admin.')->group(function () {
	Route::get('password/reset',         'showLinkRequestForm')->name('password.request');
    Route::post('password/email',        'sendResetLinkEmail' )->name('password.email'	);
    Route::get('password/reset/{token}', 'showResetForm'      )->name('password.reset'  );
    Route::post('password/reset',        'reset'              )->name('password.update' );
});