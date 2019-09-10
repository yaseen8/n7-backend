<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/admin_login', 'AuthController@admin_login');
Route::post('/logout', 'AuthController@logout');
Route::get('/logged_in_user', 'UserController@loggedInUser');
Route::get('/get_user_profile', 'UserController@get_user_profile');
Route::get('/user_list', 'UserController@user_list');
Route::get('/check_requested_email', 'RequestEmailController@get_requested_email');
Route::get('/invitation_list', 'RequestEmailController@invitation_email_list');
Route::post('/send_invitation', 'RequestEmailController@send_invitation');
Route::post('/resend_mail', 'RequestEmailController@resend_mail');
Route::get('/get_job_detail', 'JobDetailController@get_job_detail');
Route::get('/get_check_in_detail', 'TimesheetController@get_check_in_detail');
Route::get('/attendence_list', 'TimesheetController@attendence_list');
Route::post('/check_in_user', 'TimesheetController@check_in_user');
Route::post('/check_out_user', 'TimesheetController@check_out_user');
Route::get('/get_attendence_record', 'TimesheetController@get_attendence_record');
Route::get('/get_company_list', 'CompanyListController@get_company_list');
Route::post('/register', 'RegisterController@register');
Route::get('/check_user_email', 'RegisterController@check_user_email');
Route::get('/get_user_chat', 'ChatController@get_user_chat');
Route::post('/add_user_message', 'ChatController@add_user_message');










