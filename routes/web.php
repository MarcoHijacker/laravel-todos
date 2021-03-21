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
    return view('welcome');
});

Auth::routes();

// Main pages
Route::get('/home', 'HomeController@index')->name('home');

// CRUD Lists
Route::get('/create/checklist', 'ChecklistController@create') -> name('create-checklist');
Route::post('/store/checklist', 'ChecklistController@store') -> name('store-checklist');