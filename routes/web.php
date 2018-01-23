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


/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/users',                                  'Admin\UsersController@index');
    Route::get('/admin/users/create',                           'Admin\UsersController@create');
    Route::post('/admin/users',                                 'Admin\UsersController@store');
    Route::get('/admin/users/{user}/edit',                      'Admin\UsersController@edit')->name('admin/users/edit');
    Route::post('/admin/users/{user}',                          'Admin\UsersController@update')->name('admin/users/update');
    Route::delete('/admin/users/{user}',                        'Admin\UsersController@destroy')->name('admin/users/destroy');
    Route::get('/admin/users/{user}/resend-activation',         'Admin\UsersController@resendActivationEmail')->name('admin/users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/customers',                              'Admin\CustomersController@index');
    Route::get('/admin/customers/create',                       'Admin\CustomersController@create');
    Route::post('/admin/customers',                             'Admin\CustomersController@store');
    Route::get('/admin/customers/{customer}/edit',              'Admin\CustomersController@edit')->name('admin/customers/edit');
    Route::post('/admin/customers/{customer}',                  'Admin\CustomersController@update')->name('admin/customers/update');
    Route::delete('/admin/customers/{customer}',                'Admin\CustomersController@destroy')->name('admin/customers/destroy');
});