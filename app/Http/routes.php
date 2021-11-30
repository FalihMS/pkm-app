<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

Route::resource('/admin', 'AdminController');
Route::resource('/types', 'PkmTypeController');
Route::resource('/region', 'RegionController');
Route::resource('/major', 'MajorController');
Route::resource('/academic-year', 'AcademicYearController');
Route::resource('/lecturer', 'LecturerController');
Route::resource('/class', 'ClassController');
Route::resource('/session', 'CollectionSessionController');


Route::get('/student/activate-email', ['middleware' => 'activated', function(){
	return view('student.activation');	
}]);
Route::get('/student/confirm-email', 'ActivationController@confirmEmail');
Route::post('confirm-email', 'ActivationController@validateEmail');



Route::get('test',function(){
	return view('student.app');
});

Route::get('student/complete-registration', 'StudentController@completeRegister');
Route::get('student/upload', 'StudentController@uploadFile');

Route::post('student/insert-pkm-file', 'StudentController@insertPkm');
Route::post('student/insert-leader', 'StudentController@insertLeader');
Route::post('student/insert-member', 'StudentController@insertMember');
Route::post('student/rename', 'StudentController@renameFile');
Route::post('student/upload', 'StudentController@addUploadFile');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('/student','StudentController@index');
