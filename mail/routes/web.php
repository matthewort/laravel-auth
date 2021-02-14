<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/send/mail', 'HomeController@sendMail')->name('send-mail');
Route::post('/send/empty/mail', 'HomeController@sendEmptyMail')->name('send-empty-mail');
