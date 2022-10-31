<?php

use App\Http\Controllers\AjaxUser2Controller;
use App\Http\Controllers\AjaxUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Livewire\User\UserProfileComponent;

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
Route::get('/', [PageController::class, 'index'])->name('home-screen');
Route::get('/about', [PageController::class, 'about'])->name('about-us');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Accessible by User
Route::middleware(['auth'])->group(function(){
    //Posts Routes
    Route::get('/search-post', [PostController::class, 'search'])->name('posts.search');
    Route::resource('posts', PostController::class);
});

//Accessible by Admin
Route::middleware(['auth','isAdmin'])->group(function(){
    //Employees Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/add-employee', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/store-employee', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/update-employee/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/delete-employee/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/search-employee', [EmployeeController::class, 'search'])->name('employees.search');

    //Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user', [UserController::class, 'search'])->name('users.search');
    // Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/new-user', [UserController::class, 'create'])->name('users.create');
    Route::post('/new-user', [UserController::class, 'store'])->name('users.store');
    Route::get('/user/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/change-password/{id}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/change-password/{id}', [UserController::class, 'updatePassword'])->name('users.update-password');
    // Route::get('/profile-user', UserProfileComponent::class)->name('users.profile');

    //Ajax-Users Routes
    Route::get('/ajax-users', [AjaxUserController::class, 'index'])->name('ajax-users.index');
    Route::post('/ajax-user/new', [AjaxUserController::class, 'store'])->name('ajax-users.store');
    Route::get('/ajax-users/all', [AjaxUserController::class, 'showAll'])->name('ajax-users.show');
    Route::get('/ajax-user', [AjaxUserController::class, 'edit'])->name('ajax-users.edit');
    Route::post('/ajax-user', [AjaxUserController::class, 'update'])->name('ajax-users.update');
    Route::delete('/ajax-user', [AjaxUserController::class, 'destroy'])->name('ajax-users.delete');
});