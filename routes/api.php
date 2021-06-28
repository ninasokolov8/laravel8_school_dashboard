<?php
	
	//Login - you must login to get the token for Auth for all the Api calls.
	Route::post('api-login', [\App\Http\Controllers\Api\RegisterController::class, 'login']);
	
	Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']], function () {
		// Permissions
		Route::apiResource('permissions', 'PermissionsApiController');
		// Roles
		Route::apiResource('roles', 'RolesApiController');
		// Users
		Route::apiResource('users', 'UsersApiController');
		// Lessons
		Route::apiResource('lessons', 'LessonsApiController');
		// Grades
		Route::apiResource('grades', 'GradesApiController');
		// School Classes
		Route::apiResource('school-classes', 'SchoolClassesApiController');
	});
