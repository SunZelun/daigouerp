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
    Route::get('/admin',                                  'DashboardController@index');
    Route::get('/admin/dashboard',                                  'DashboardController@index');
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

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/customer-addresses',                     'Admin\CustomerAddressesController@index');
    Route::get('/admin/customer-addresses/create',              'Admin\CustomerAddressesController@create');
    Route::post('/admin/customer-addresses',                    'Admin\CustomerAddressesController@store');
    Route::get('/admin/customer-addresses/{customerAddress}/edit','Admin\CustomerAddressesController@edit')->name('admin/customer-addresses/edit');
    Route::post('/admin/customer-addresses/{customerAddress}',  'Admin\CustomerAddressesController@update')->name('admin/customer-addresses/update');
    Route::delete('/admin/customer-addresses/{customerAddress}','Admin\CustomerAddressesController@destroy')->name('admin/customer-addresses/destroy');
    Route::get('/admin/customer-addresses/get-address-by-customer','Admin\CustomerAddressesController@getAddressByCustomer');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/products',                               'Admin\ProductsController@index');
    Route::get('/admin/products/create',                        'Admin\ProductsController@create');
    Route::post('/admin/products',                              'Admin\ProductsController@store');
    Route::get('/admin/products/{product}/edit',                'Admin\ProductsController@edit')->name('admin/products/edit');
    Route::post('/admin/products/{product}',                    'Admin\ProductsController@update')->name('admin/products/update');
    Route::delete('/admin/products/{product}',                  'Admin\ProductsController@destroy')->name('admin/products/destroy');
    Route::get('/admin/products/search',                  'Admin\ProductsController@search');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/orders',                                 'Admin\OrdersController@index');
    Route::get('/admin/orders/add-product',                     'Admin\OrdersController@addProduct');
    Route::get('/admin/orders/create',                          'Admin\OrdersController@create');
    Route::post('/admin/orders',                                'Admin\OrdersController@store');
    Route::get('/admin/orders/{order}/edit',                    'Admin\OrdersController@edit')->name('admin/orders/edit');
    Route::get('/admin/orders/{order}',                    'Admin\OrdersController@show');
    Route::post('/admin/orders/{order}',                        'Admin\OrdersController@update')->name('admin/orders/update');
    Route::delete('/admin/orders/{order}',                      'Admin\OrdersController@destroy')->name('admin/orders/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/sys-codes',                              'Admin\SysCodesController@index');
    Route::get('/admin/sys-codes/create',                       'Admin\SysCodesController@create');
    Route::post('/admin/sys-codes',                             'Admin\SysCodesController@store');
    Route::get('/admin/sys-codes/{sysCode}/edit',               'Admin\SysCodesController@edit')->name('admin/sys-codes/edit');
    Route::post('/admin/sys-codes/{sysCode}',                   'Admin\SysCodesController@update')->name('admin/sys-codes/update');
    Route::delete('/admin/sys-codes/{sysCode}',                 'Admin\SysCodesController@destroy')->name('admin/sys-codes/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/shipments',                              'Admin\ShipmentsController@index');
    Route::get('/admin/shipments/create',                       'Admin\ShipmentsController@create');
    Route::post('/admin/shipments',                             'Admin\ShipmentsController@store');
    Route::get('/admin/shipments/{shipment}/edit',              'Admin\ShipmentsController@edit')->name('admin/shipments/edit');
    Route::post('/admin/shipments/{shipment}',                  'Admin\ShipmentsController@update')->name('admin/shipments/update');
    Route::delete('/admin/shipments/{shipment}',                'Admin\ShipmentsController@destroy')->name('admin/shipments/destroy');
});