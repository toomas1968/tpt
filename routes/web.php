<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
  
	Route::get('/home', 'HomeController@index')->name('home');


	Route::get('/users', 'UsersController@index')->name('user');
	Route::get('/users/edit/{id}', 'UsersController@show')->name('user_edit');
	Route::get('/users/add', 'UsersController@create')->name('create_user');
	Route::post('/users/add', 'UsersController@store')->name('store_user');
	Route::post('/users/delete/{id}', 'UsersController@destroy')->name('delete_user');
	Route::post('/users/restore/{id}', 'UsersController@restore')->name('restore_user');
	Route::post('/users/update/{id}', 'UsersController@update')->name('update_user');


	Route::get('/roles', 'RolesController@index')->name('roles');
	Route::get('/roles/add', 'RolesController@create')->name('add_role');
	Route::get('/roles/edit/{id}', 'RolesController@show')->name('editRoles');
	Route::post('/roles/add', 'RolesController@store')->name('create_role');
	Route::post('/roles/update/{id}', 'RolesController@update')->name('update_roles');
	Route::post('/roles/{id}', 'RolesController@destroy')->name('delete_role');

});