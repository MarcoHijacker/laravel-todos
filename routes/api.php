<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistApiController;

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
// Api INDEX
Route::get('/checklists', [ChecklistApiController::class, 'index']);
// Api CREATE
Route::post('/checklists', [ChecklistApiController::class, 'create']);
// Api UPDATE
Route::post('/checklists/{id}', [ChecklistApiController::class, 'update']);
// Api DESTROY
Route::delete('/checklists/{id}', [ChecklistApiController::class, 'destroy']);
