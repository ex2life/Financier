<?php

use Illuminate\Support\Facades\Route;

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
//Профиль пользователя
Route::get('/profile', 'Auth\UserController@profile')->name('profile');

//Домашняя страница
Route::get('/', function () {
    return view('index');
})->name('index');

//Страница для выбора типа платежей
Route::get('/calc', 'CalcController@calc_list')->name('calc_list');
//Страница для ввода данных о кредите с ануитетной схемой платежей
Route::get('/calc/annuit', 'CalcController@calc_input')->defaults('type', 'annuit')->name('calc_annuit');
//Страница для ввода данных о кредите с дифференцированной схемой платежей
Route::get('/calc/differ', 'CalcController@calc_input')->defaults('type', 'differ')->name('calc_differ');
//Страница для ввода данных о кредите с гибкой схемой платежей
Route::get('/calc/flex', 'CalcController@calc_input')->defaults('type', 'flex')->name('calc_flex');
//Расчет графика платежей в требуемом формате (html для всплывающего окна, pdf-файл, xls-файл)
Route::post('/calc/calc_graf', 'CalcController@calc')->name('calc_graf');

//Аутентификация через социальные сети
Route::get('auth/{provider}', 'Auth\SocialController@redirectToSocial')->name('auth_social');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleCallback')->name('auth_social_callback');

//deprecated
Route::get('/home', 'HomeController@index')->name('home');
