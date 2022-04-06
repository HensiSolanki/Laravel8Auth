<?php

use Illuminate\Support\Facades\Route;


// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::group(['middleware' => 'admin.auth'], function () {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('home');

    // Products
    Route::get("/isProductnameAvailable", 'ProductController@isProductnameAvailable')->name('validate');
    Route::get("/isEditProductNameAvailable", 'ProductController@isEditProductNameAvailable')->name('validateProduct');
    Route::resource('/products', 'ProductController');
    Route::get("/profile", 'HomeController@profile')->name("profile");
    Route::get("/users", 'UsersController@index')->name("userIndex");
    Route::get("/users/view/{id}", 'UsersController@show')->name("userView");
    Route::delete("/users/delete/{id}", 'UsersController@destroy')->name("userDelete");
    Route::get('users/datatable', 'UsersController@getUsers')->name('list-users');
});
