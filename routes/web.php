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

    /*
	|--------------------------------------------------------------------------
	| Blog Routes
	|--------------------------------------------------------------------------
	*/
    Route::controller(BlogController::class)->prefix('blogs')->as('web.blogs.')->group(function () {
        Route::get('list',          'index' )->name('index');
        Route::get('show/{id}',     'show'  )->name('show' );
    });
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
		Route::post('store', 	    'store'     )->name('chiller.store'     );
	});
});
