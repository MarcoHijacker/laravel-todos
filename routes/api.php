<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistApiController;
use App\Http\Controllers\TaskApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CHECKLIST API:
// INDEX
Route::get('/checklists', [ChecklistApiController::class, 'index']);
// BOUNDED INDEX
Route::post('/checklists/user', [ChecklistApiController::class, 'related']);
// CREATE
Route::post('/checklists', [ChecklistApiController::class, 'create']);
// UPDATE
Route::post('/checklists/{id}', [ChecklistApiController::class, 'update']);
// DESTROY
Route::delete('/checklists/{id}', [ChecklistApiController::class, 'destroy']);

// TASK API:
// INDEX
Route::get('/tasks', [TaskApiController::class, 'index']);
// BOUNDED INDEX
Route::get('/tasks/{id}', [TaskApiController::class, 'related']);
// TASKS BALANCE
Route::get('/tasks/balance/{id}', [TaskApiController::class, 'balance']);
// CREATE
Route::post('/tasks', [TaskApiController::class, 'create']);
// UPDATE
Route::post('/tasks/{id}', [TaskApiController::class, 'update']);
// DESTROY
Route::delete('/tasks/{id}', [TaskApiController::class, 'destroy']);

