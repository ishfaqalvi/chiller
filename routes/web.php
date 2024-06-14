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
Route::group(['namespace' => 'App\Http\Controllers\Web\Auth'], function () {
    /*
	|--------------------------------------------------------------------------
	| Register Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(RegisterController::class)->group(function () {
	    Route::get('register', 		 'showRegisterForm')->name('web.showRegisterForm');
	    Route::post('register', 	 'register'		   )->name('web.registger'  	 );
        Route::post('check_email', 	 'checkEmail'	   )->name('web.checkEmail'  	 );
	});

    /*
	|--------------------------------------------------------------------------
	| Login Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(LoginController::class)->group(function () {
	    Route::get('login', 	'showLoginForm')->name('web.showLoginForm');
	    Route::post('login',    'login'		   )->name('web.login'  	  );
	});

    /*
	|--------------------------------------------------------------------------
	| Social Login Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(SocialLoginController::class)->group(function () {
	    Route::get('login/google',           'redirectToGoogleProvider'      )->name('web.login.google'          );
        Route::get('login/google/callback',  'handleProviderGoogleCallback'  )->name('web.login.googleCallback'  );
        Route::get('login/facebook',         'redirectToFacebookProvider'    )->name('web.login.facebook'        );
        Route::get('login/facebook/callback','handleProviderFacebookCallback')->name('web.login.facebookCallback');
	});

    /*
	|--------------------------------------------------------------------------
	| Forgot Password Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(ForgotPasswordController::class)->group(function () {
	    Route::get('password/reset',   'showLinkRequestForm')->name('web.password.request');
        Route::post('password/email',  'sendResetLinkEmail' )->name('web.password.email'  );
	});

    /*
	|--------------------------------------------------------------------------
	| Reset Password Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(ResetPasswordController::class)->group(function () {
	    Route::get('password/reset/{token}', 'showResetForm')->name('web.password.reset' );
        Route::post('password/reset',        'reset'        )->name('web.password.update');
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
	| Pages Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(PageController::class)->group(function () {
        Route::get('/',                 'home'          )->name('home'              );
        Route::get('privacy-policy',    'privacyPolicy' )->name('privacy-policy'    );
        Route::get('terms-of-service',  'termsOfService')->name('terms-of-service'  );
        Route::get('agreement',         'agreement'     )->name('agreement'         );
    });

    /*
	|--------------------------------------------------------------------------
	| Blog Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(BlogController::class)->prefix('blogs')->as('web.blogs.')->group(function () {
        Route::get('list',          'index' )->name('index');
        Route::get('show/{id}',     'show'  )->name('show' );
    });

    /*
	|--------------------------------------------------------------------------
	| NewsLetter Routes
	|--------------------------------------------------------------------------
	*/
	Route::post('news-letter/store', 'NewsletterController@store')->name('web.news-letter.store');

    /*
	|--------------------------------------------------------------------------
	| Contact Us Routes
	|--------------------------------------------------------------------------
	*/
    Route::post('contacts/store', 'ContactController@store')->name('web.contacts.store');
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
		Route::post('logout', 		'logout'		)->name('customer.logout'	   );
		Route::get('profile',		'profile'		)->name('customer.profile'	   );
		Route::post('update',		'update' 		)->name('customer.update' 	   );
		Route::post('billing-info', 'billingInfo' 	)->name('customer.billing.info');
	});

	/*
	|--------------------------------------------------------------------------
	| Projects Routes
	|--------------------------------------------------------------------------
	*/
	Route::controller(ProjectController::class)->prefix('projects')->group(function () {
		Route::get('list', 		    'index'     )->name('project.index'	    );
		Route::get('create', 	    'create'    )->name('project.create'    );
		Route::post('store', 	    'store'     )->name('project.store'     );
		Route::get('show/{id}', 	'show'      )->name('project.show'      );
		Route::get('calculate/{id}','calculate' )->name('project.calculate' );
		Route::post('set_chiller', 	'setChiller')->name('project.setChiller');
	});

    /*
	|--------------------------------------------------------------------------
	| Chiller Routes
	|--------------------------------------------------------------------------
	*/
	Route::controller(ChillerController::class)->prefix('chiller')->group(function () {
		Route::get('list', 		    'index'     )->name('chiller.index'	    );
		Route::get('create', 	    'create'    )->name('chiller.create'    );
		Route::get('get_models', 	'getModels' )->name('chiller.models'    );
		Route::post('store', 	    'store'     )->name('chiller.store'     );
	});
});
