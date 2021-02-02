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

Route::get('/', function () {

    return 'hello world';

});


Route::get('/meow','test_controller@meow');

Route::post('/insert','test_controller@insert');
Route::post('/update','test_controller@update');
Route::post('/delete','test_controller@del');
