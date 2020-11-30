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
//routes for showin page

Route::group(['middleware' => 'web'], function(){
Route::get('/', 'Controller@routing');


//Group routes for visitors
Route::group(['middleware' => 'visitor'], function(){
//routes for registration page
Route::get('/register', 'RegistrationController@register');

//routes for registration of user
Route::post('/register', 'RegistrationController@postRegister');


//routes for login page
Route::get('/login', 'LoginController@login');

//routes for user login
Route::post('/login', 'LoginController@postLogin');

//route for forgotten password
Route::get('/password_forgot', 'PasswordForgotController@Passwordforgot');

//route for activation forgotten password
Route::post('/password_forgot', 'PasswordForgotController@postPasswordForgot');

//route for reset  password page
Route::get('/reset/{email}/{resetCode}', 'PasswordForgotController@resetPassword');
//route for reset  chage password page(form)
Route::post('/reset/{email}/{resetCode}', 'PasswordForgotController@postResetPassword');
});



//routes for logout page
Route::post('/logout', 'LoginController@logout');

//routes for admin content
Route::get('/viewersProfiles', 'AdminController@viewersProfiles')->middleware('admin')->name('viewers.profiles');

//routes for admins list
Route::get('/adminsProfiles', 'AdminController@adminsProfiles')->middleware('admin')->name('admins.profiles');


//routes delete a viewer
Route::get('/delete/{id}', 'AdminController@postAdminDelete')->middleware('admin')->name('admin.delete');

//Routes for create admins  in admin panel

Route::get('/createAdmin', 'AdminController@getAdminCreate')->middleware('admin')->name('admin.create');

Route::post('/createAdmin', 'AdminController@postAdminCreate')->middleware('admin')->name('admin.create');



//Routes for create viewers  in admin panel
Route::get('/createViewer', 'AdminController@getViewerCreate')->middleware('admin')->name('viewer.create');

Route::post('/createViewer', 'AdminController@postViewerCreate')->middleware('admin')->name('viewer.create');


//routes for geting edit page

Route::get('/edit/{id}', 'AdminController@getAdminEdit')->middleware('admin')->name('admin.edit');

//routes for edit a user profile
Route::post('/edit', 'AdminController@postAdminUpdate')->middleware('admin')->name('admin.update');



//routes for viewer profil
Route::get('/viewersProfile/{first_name}', 'AdminController@showViewerProfile')->middleware('viewer')->name('show.viewer.profile');

//routes for admin profil
Route::get('/adminProfile/{first_name}', 'AdminController@showAdminProfile')->middleware('admin')->name('show.admin.profile');





//routes for user activation page
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');



//routes for client list from rest api
Route::get('/home', 'ClientsController@getClients')->middleware('viewer')->name('clients.home');

//routes for get change frequencies page
Route::get('/deleteClient/{id}', 'ClientsController@deleteClient')->middleware('admin')->name('client.delete');
//Routes for client profile
Route::get('/clientProfile/{id}', 'ClientsController@getClientProfile')->middleware('clients')->name('client.profile');





//routes for create client
Route::get('/createClient', 'ClientsController@getCreateClient')->middleware('admin')->name('client.create');
Route::post('/createClient', 'ClientsController@postCreateClient', 'nocrsf => true')->middleware('admin')->name('client.create');
//routes for edit client frequencies
Route::get('/editClient/{clientId}', 'ClientsController@getEditClient')->middleware('admin')->name('client.edit');
Route::post('/editClient/{clientId}', 'ClientsController@postEditClient')->middleware('admin')->name('client.update');


//routes for edit client ip and ports
Route::get('/editClientPort/{clientId}', 'ClientsController@getEditClientPort')->middleware('admin')->name('client.edit.port');
Route::post('/editClientPort/{clientId}', 'ClientsController@postEditClientPort')->middleware('admin')->name('client.update.port');

//routes for charts pages
Route::get('/charts', 'ChartsController@getCharts')->middleware('viewer')->name('charts.show');

});
//This little code is used because command "(count($user)==0) show error newer version of laravel 5.6(php 7.2)
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}