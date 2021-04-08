<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Main pages
Route::get('/home', 'HomeController@index')->name('home');

// Checklist CRUD
Route::get('/personal/checklist', 'ChecklistController@personal') -> name('user-checklist');
Route::get('/create/checklist', 'ChecklistController@create') -> name('create-checklist');
Route::get('/show/checklist/{id}', 'ChecklistController@show') -> name('show-checklist');
Route::post('/store/checklist', 'ChecklistController@store') -> name('store-checklist');
Route::get('/edit/checklist/{id}', 'ChecklistController@edit') -> name('edit-checklist');
Route::post('/update/checklist/{id}', 'ChecklistController@update') -> name('update-checklist');
Route::get('/destroy/checklist/{id}', 'ChecklistController@destroy') -> name('destroy-checklist');

// Task CRUD
Route::get('/create/task', 'TaskController@create') -> name('create-task');