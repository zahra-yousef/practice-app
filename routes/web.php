<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/users/{id}/{comp}', [PageController::class, 'users']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isAdmin'])->group(function(){
    //Posts Routes
    Route::resource('posts', PostController::class);

    //Employees Routes
    Route::get('/employee', [EmployeeController::class, 'index']);
    Route::get('/add-employee', [EmployeeController::class, 'create']);
    Route::post('/store-employee', [EmployeeController::class, 'store']);
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
    Route::put('/update-employee/{id}', [EmployeeController::class, 'update']);
    Route::get('/delete-employee/{id}', [EmployeeController::class, 'destroy']);
});

