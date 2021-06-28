<?php
	
	
	Route::redirect('/', '/login');
	Route::get('/home', function () {
		$routeName = auth()->user() && (auth()->user()->is_student || auth()->user()->is_teacher) ? 'dashboard.calendar.index' : 'dashboard.home';
		if (session('status')) {
			return redirect()->route($routeName)->with('status', session('status'));
		}
		
		return redirect()->route($routeName);
	});
	
	Auth::routes(['register' => false]);
	// Admin
	
	Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard', 'middleware' => ['auth']],
		function () {
			Route::get('/', 'HomeController@index')->name('home');
			// Permissions
			Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
			Route::resource('permissions', 'PermissionsController');
			
			// Roles
			Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
			Route::resource('roles', 'RolesController');
			
			// Users
			Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
			Route::resource('users', 'UsersController');
			
			// Lessons
			Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
			Route::resource('lessons', 'LessonsController');
			
			// School Classes
			Route::delete('school-classes/destroy',
				'SchoolClassesController@massDestroy')->name('school-classes.massDestroy');
			Route::resource('school-classes', 'SchoolClassesController');
			
			// Grades
			Route::delete('grades/destroy', 'GradesController@massDestroy')->name('grades.massDestroy');
			Route::get('grades/getbyfilter', 'GradesController@getByFilter');
			Route::resource('grades', 'GradesController');
			
			Route::get('calendar', 'CalendarController@index')->name('calendar.index');
		});
