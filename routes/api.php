<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Employee
Route::post('/add-employee',[ApiController::class, 'createEmp']);
Route::get('/employees',[ApiController::class, 'showEmp']);
Route::get('/employee/{id}',[ApiController::class, 'showEmpById']);
Route::put('/update-employee/{id}',[ApiController::class, 'updateEmp']);
Route::delete('/delete-employee/{id}',[ApiController::class, 'destroyEmp']);

//Post
Route::post('/add-post',[ApiController::class, 'createPost']);
Route::get('/posts',[ApiController::class, 'showPost']);
Route::get('/post/{id}',[ApiController::class, 'showPostById']);
Route::put('/update-post/{id}',[ApiController::class, 'updatePost']);
Route::delete('/delete-post/{id}',[ApiController::class, 'destroyPost']);
