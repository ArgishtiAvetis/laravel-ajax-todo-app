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

use App\Task;

Route::get('/', 'TasksController@index');
Route::get('/task/{id}', 'TasksController@single');

Route::post('/add-task', 'TasksController@add');
Route::post('/delete-task/{id}', 'TasksController@delete');