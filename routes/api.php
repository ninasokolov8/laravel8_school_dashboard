<?php
	
	
	Route::post('login', [\App\Http\Controllers\Api\RegisterController::class, 'login']);
	
	Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']], function () {
		// Permissions
		Route::apiResource('permissions', 'PermissionsApiController');
		// Roles
		Route::apiResource('roles', 'RolesApiController');
		// Users
		Route::apiResource('users', 'UsersApiController');
		// Lessons
		Route::apiResource('lessons', 'LessonsApiController');
		// School Classes
		Route::apiResource('school-classes', 'SchoolClassesApiController');
	});
