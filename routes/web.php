<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

//Accessible by Guest
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/users/{id}/{comp}', [PageController::class, 'users']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Accessible by Admin
Route::middleware(['auth'])->group(function(){
    //Users Routes
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/search-user', [UserController::class, 'search']);
    Route::get('/show-user/{id}', [UserController::class, 'show']);
});

//Accessible by Admin
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
    Route::get('/search-employee', [EmployeeController::class, 'search']);

     //Users Routes
    Route::get('/add-user', [UserController::class, 'create']);
    Route::post('/store-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/update-user/{id}', [UserController::class, 'update']);
    Route::get('/delete-user/{id}', [UserController::class, 'destroy']);
});

