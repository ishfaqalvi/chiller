<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::controller(ChillerController::class)->prefix('chillers')->as('chillers.')->group(function () {
	Route::get('list',				 	'index'	 	    )->name('index'  	  );
	Route::get('create',			 	'create'	    )->name('create' 	  );
	Route::post('store',			 	'store'	 	    )->name('store'  	  );
	Route::get('edit/{id}',			 	'edit'		    )->name('edit'	  	  );
	Route::get('show/{id}',			 	'show'		    )->name('show'	  	  );
	Route::patch('update/{chiller}',    'update'	    )->name('update' 	  );
	Route::delete('delete/{id}',	 	'destroy' 	    )->name('destroy'	  );
    Route::get('get_models', 	        'getModels'     )->name('models'      );
	Route::post('valid-formula',	    'validFormula'	)->name('validFormula');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::controller(CustomerController::class)->prefix('customers')->as('customers.')->group(function () {
	Route::get('list',				 	'index'	 	)->name('index'  	);
	Route::get('create',			 	'create'	)->name('create' 	);
	Route::post('store',			 	'store'	 	)->name('store'  	);
	Route::get('edit/{id}',			 	'edit'		)->name('edit'	  	);
	Route::get('show/{id}',			 	'show'		)->name('show'	  	);
	Route::patch('update/{customer}',   'update'	)->name('update' 	);
	Route::delete('delete/{id}',	 	'destroy' 	)->name('destroy'	);
	Route::post('check-email', 		 	'checkEmail')->name('checkEmail');
});

/*
|--------------------------------------------------------------------------
| Project Routes
|--------------------------------------------------------------------------
*/
Route::controller(ProjectController::class)->prefix('projects')->as('projects.')->group(function () {
	Route::get('list',				 	'index'	 	)->name('index'  	);
	Route::get('create',			 	'create'	)->name('create' 	);
	Route::post('store',			 	'store'	 	)->name('store'  	);
	Route::get('edit/{id}',			 	'edit'		)->name('edit'	  	);
	Route::get('show/{id}',			 	'show'		)->name('show'	  	);
	Route::patch('update/{project}',   'update'	    )->name('update' 	);
	Route::delete('delete/{id}',	 	'destroy' 	)->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Blogs Routes
|--------------------------------------------------------------------------
*/
Route::resource('blogs', BlogController::class);

/*
|--------------------------------------------------------------------------
| Brands Routes
|--------------------------------------------------------------------------
*/
Route::resource('brands', BrandController::class);

/*
|--------------------------------------------------------------------------
| Models Routes
|--------------------------------------------------------------------------
*/
Route::resource('models', ModelController::class);

/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/
Route::resource('contacts', ContactController::class);

/*
|--------------------------------------------------------------------------
| News Letters Routes
|--------------------------------------------------------------------------
*/
Route::resource('news-letters', NewsLetterController::class);

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/
Route::resource('roles', RoleController::class);

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
	Route::get('list',				'index'			)->name('index'		   );
	Route::get('create',			'create'		)->name('create'	   );
	Route::post('store',			'store'			)->name('store'		   );
	Route::get('edit/{id}',			'edit'			)->name('edit'		   );
	Route::get('show/{id}',			'show'			)->name('show'		   );
	Route::patch('update/{user}',	'update'		)->name('update'	   );
	Route::delete('delete/{id}',	'destroy'		)->name('destroy'	   );
	Route::get('profile', 		 	'profileEdit'	)->name('profileEdit'  );
    Route::post('profile',		 	'profileUpdate'	)->name('profileUpdate');
    Route::post('check_email', 	 	'checkEmail'	)->name('checkEmail'   );
    Route::post('check_password',	'checkPassword'	)->name('checkPassword');
});

/*
|--------------------------------------------------------------------------
| Notifications Routes
|--------------------------------------------------------------------------
*/
Route::controller(NotificationController::class)->prefix('notifications')->as('notifications.')->group(function () {
	Route::get('index', 		  	'index'  )->name('index'  );
	Route::get('show/{id}', 		'show'   )->name('show'	  );
	Route::delete('destroy/{id}', 	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Audit Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuditController::class)->prefix('audits')->as('audits.')->group(function () {
	Route::get('index', 		 	'index'	 )->name('index'  );
	Route::get('show/{id}', 	 	'show'	 )->name('show'	  );
	Route::delete('destroy/{id}',	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::controller(SettingController::class)->prefix('settings')->as('settings.')->group(function () {
	Route::get('index', 		'index'		)->name('index'		  );
	Route::get('clear-cache', 	'clearCache')->name('clear-cache' );
	Route::post('save', 		'save'		)->name('save'		  );
});

/*
|--------------------------------------------------------------------------
| Error Log Route
|--------------------------------------------------------------------------
*/
Route::get('logs',
	[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']
)->name('logs');
