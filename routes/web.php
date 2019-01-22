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

Auth::routes();
Route::group(['prefix' => '/'], function() {
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth/login');
        };
    });
    Route::get('slack/login', 'Auth\AuthenticateController@slackAuth');
    Route::get('callback', 'Auth\AuthenticateController@userinfo');

    Route::get('home', 'UserController@index')->name('home');
    Route::post('home', 'UserController@update')->name('home.update');

    Route::resource('report', 'DailyReportController');

    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/register/{query}', 'Auth\RegisterController@showRegistrationForm');

    Route::resource('question', 'QuestionController');
    Route::get('question/{id}/mypage', ['as' => 'question.mypage', 'uses' => 'QuestionController@myPage']);
    Route::post('question/confirm', ['as' => 'question.confirm', 'uses' => 'QuestionController@confirm']);
    Route::post('question/{id}/confirm', ['as' => 'confirm.update', 'uses' => 'QuestionController@confirm']);
    Route::post('question/{id}/comment', ['as' => 'question.comment', 'uses' => 'QuestionController@storeComment']);

    Route::get('attendance', ['as' => 'attendance.index', 'uses' => 'AttendanceController@index']);
    Route::get('attendance/absence', ['as' => 'attendance.absence', 'uses' => 'AttendanceController@showAbsenceForm']);
    Route::get('attendance/modify', ['as' => 'attendance.modify', 'uses' => 'AttendanceController@showModifyForm']);
    Route::get('attendance/mypage', ['as' => 'attendance.mypage', 'uses' => 'AttendanceController@showMypage']);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::resource('report', DailyReportController::class, ['only' => ['index', 'show']]);
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::resource('adminuser', AdminUserController::class);
    Route::get('adminuser/{adminuser}/mailedit', ['as' => 'adminuser.mailedit', 'AdminUserController@mailedit']);
    Route::post('adminuser/sendmail', ['as' => 'adminuser.sendmail', 'uses' => 'AdminUserController@sendmail']);
    Route::resource('user', 'UserController', ['except' => ['create', 'store']]);
    Route::post('password/email',['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset',['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ResetPasswordController@reset']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

    Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AdminRegisterController@adminRegister']);
    Route::get('/register/', 'Auth\AdminRegisterController@showAdminRegistrationForm');

    Route::resource('user', UserController::class);

    // access_right
    Route::get('/access_right', ['as' => 'access_right.index', 'uses' => 'AccessRightController@index']);
    Route::post('/access_right/sendSlack', ['as' => 'access_right.sendSlack', 'uses' => 'AccessRightController@sendSlack']);
    Route::get('/access_right/permission', ['as' => 'access_right.permission', 'uses' => 'AccessRightController@permission']);
    Route::post('/access_right/replyMail/{query}', ['as' => 'access_right.replyMail', 'uses' => 'AccessRightController@replyMail']);

    Route::get('question/create', ['as' => 'question.create', 'uses' => 'QuestionController@create']);
    Route::put('question/create', ['as' => 'question.updateAnswer', 'uses' => 'QuestionController@updateAnswer']);
    Route::resource('question', QuestionController::class);

});

