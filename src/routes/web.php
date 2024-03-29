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
Route::get('/profile', 'Auth\UserController@profile')->name('profile')->middleware('auth');
Route::put('/profile', 'Auth\UserController@update')->name('profile_update')->middleware('auth');
Route::put('/profile/changePassword', 'Auth\UserController@changePassword')->name('profile_changePassword')->middleware('auth');
Route::post('/profile/uploadAvatar', 'Auth\UserController@uploadAvatar')->name('profile_uploadAvatar')->middleware('auth');

//Домашняя страница
Route::get('/', function () {
    return view('index');
})->name('index');
//Политика конфиденсальности
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

//РАСЧЕТ ГРАФИКА КРЕДИТНЫХ ПЛАТЕЖЕЙ
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

//РАСЧЕТ КРЕДИНОГО ЛИМИТА
//Меню
Route::get('/limit', 'Limit\LimitController@limit_list')->name('limit_list')->middleware('auth');
//Группы связанных заемщиков пользователя
Route::get('/limit/gsz', 'Limit\GszController@gsz_list')->name('gsz_list')->middleware('auth');
Route::post('/limit/gsz/add', 'Limit\GszController@gsz_add')->name('gsz_add')->middleware('auth');
Route::delete('/limit/gsz/{id}/del', 'Limit\GszController@gsz_delete')->name('gsz_delete')->middleware('auth');
Route::post('/limit/gsz/{id}/edit', 'Limit\GszController@gsz_edit')->name('gsz_edit')->middleware('auth');
//Компании группы связанных заемщиков
Route::get('/limit/gsz/{id}', 'Limit\CompanyController@company_list')->name('company_list')->middleware('auth');
Route::post('/limit/gsz/{id}/company/add', 'Limit\CompanyController@company_add')->name('company_add')->middleware('auth');
Route::delete('/limit/gsz/company/{id}/del', 'Limit\CompanyController@company_delete')->name('company_delete')->middleware('auth');
Route::post('/limit/gsz/company/{id}/edit', 'Limit\CompanyController@company_edit')->name('company_edit')->middleware('auth');
//Финансовые данные
Route::get('/limit/gsz_dates', 'Limit\GszController@gsz_dates')->name('gsz_dates')->middleware('auth');
Route::get('/limit/gsz_dates/{id}', 'Limit\CompanyController@company_finance_list')->name('company_finance_list')->middleware('auth');
Route::post('/limit/gsz_dates/{id}/edit', 'Limit\GszController@gsz_edit_date')->name('gsz_date_edit')->middleware('auth');
Route::get('/limit/gsz_dates/balance/{id}', 'Limit\LimitController@company_balance')->name('company_balance')->middleware('auth');
Route::post('/limit/gsz_dates/balance/date/{id}/save', 'Limit\LimitController@save_balance')->name('save_balance')->middleware('auth');
//Финансовые результаты
Route::get('/limit/gsz_dates/finance_result/{id}', 'Limit\LimitController@company_finance_result')->name('company_finance_result')->middleware('auth');
Route::post('/limit/gsz_dates/finance_result/date/{id}/save', 'Limit\LimitController@save_finance_result')->name('save_finance_result')->middleware('auth');
//Данные о кредите
Route::get('/limit/gsz_credit_info', 'Limit\GszController@credit_info')->name('credit_info')->middleware('auth');
Route::post('/limit/gsz_credit_info/{id}/edit', 'Limit\LimitController@credit_info_edit')->name('credit_info_edit')->middleware('auth');
//Кредитный лимит
Route::get('/limit/gsz_credit_limit', 'Limit\GszController@credit_limit_list')->name('credit_limit_list')->middleware('auth');
Route::get('/limit/gsz_credit_limit/{id}', 'Limit\LimitController@credit_limit')->name('credit_limit')->middleware('auth');

//Финансовый анализ
Route::get('/analise/gsz_list', 'Limit\GszController@analise_gsz_list')->name('analise_gsz_list')->middleware('auth');
Route::get('/analise/gsz/{id}', 'Limit\CompanyController@analise_company_list')->name('analise_company_list')->middleware('auth');
Route::get('/analise/gsz/company/{id}', 'Limit\CompanyController@analise_company')->name('analise_company')->middleware('auth');

//Бухгалтерия
Route::get('/buh', 'Limit\GszController@buh')->name('buh')->middleware('auth');
Route::get('/buh/finance_result/{id}', 'Limit\LimitController@buh_company_finance_result')->name('buh_company_finance_result')->middleware('auth');
Route::get('/buh/balance/{id}', 'Limit\LimitController@buh_company_balance')->name('buh_company_balance')->middleware('auth');

//Аутентификация через социальные сети
Route::get('auth/{provider}', 'Auth\SocialController@redirectToSocial')->name('auth_social');
Route::get('auth/{provider}/del', 'Auth\SocialController@DelSocial')->name('auth_social_del')->middleware('auth');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleCallback')->name('auth_social_callback');

//deprecated
Route::get('/home', 'HomeController@index')->name('home');;
