<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Main pages
Route::get('/home', 'HomeController@index')->name('home');

// CRUD Lists
Route::get('/index/checklist', 'ChecklistController@index') -> name('index-checklist');
Route::get('/create/checklist', 'ChecklistController@create') -> name('create-checklist');
Route::post('/store/checklist', 'ChecklistController@store') -> name('store-checklist');