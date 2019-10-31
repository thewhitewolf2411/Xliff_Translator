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
Route::put('language', 'LanguagesController@switchLanguage');
Auth::routes();
Route::get('/', 'InterfaceController@showIndex');

Route::get('/landing', 'InterfaceController@showInterface')->middleware('auth');

Route::post('/convertor', 'ConvertorController@convert');
Route::post('/interface/exporter', 'ExporterController@export');

Route::get('/interface/export', 'InterfaceController@showExport')->middleware('auth');
Route::get('/interface/convert', 'InterfaceController@showConvert')->middleware('auth');

