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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/calc', 'CalcController@calc_list')->name('calc_list');
Route::get('/calc/annuit', 'CalcController@calc_input')->defaults('type', 'annuit')->name('calc_annuit');
Route::get('/calc/differ', 'CalcController@calc_input')->defaults('type', 'differ')->name('calc_differ');
Route::get('/calc/flex', 'CalcController@calc_input')->defaults('type', 'flex')->name('calc_flex');
Route::POST('/calc/calc_graf', 'CalcController@calc_to_html')->name('calc_graf');

Route::get('/home', 'HomeController@index')->name('home');
