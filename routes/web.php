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
    Route::get('/search-user', [UserController::class, 'search'])->name('users.search');
    Route::get('/show-user/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/add-user', [UserController::class, 'create'])->name('users.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/change-password-user/{id}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/update-password-user/{id}', [UserController::class, 'updatePassword'])->name('users.update-password');
    // Route::get('/profile-user', UserProfileComponent::class)->name('users.profile');

    //Ajax-Users Routes
    Route::get('/ajax-users', [AjaxUserController::class, 'index'])->name('ajax-users.index');
    // Route::get('/ajax-show-users', [AjaxUserController::class, 'show'])->name('ajax-users.show');
    Route::get('/ajax-show-user/{id}', [AjaxUserController::class, 'showSingleUser'])->name('ajax-users.showSingle');
    Route::get('/ajax-search-user', [AjaxUserController::class, 'search'])->name('ajax-users.search');
    Route::post('/ajax-add-user', [AjaxUserController::class, 'store'])->name('ajax-users.store');
    Route::put('/ajax-update-user/{id}', [AjaxUserController::class, 'update'])->name('ajax-users.update');
    Route::delete('/ajax-delete-user/{id}', [AjaxUserController::class, 'destroy'])->name('ajax-users.destroy');
    Route::get('/pagination/pagiante-data', [AjaxUserController::class, 'pagination']);

    //Addiotional 
    Route::get('/ajax-users2', [AjaxUser2Controller::class, 'index'])->name('ajax-users2.index');
    Route::post('/ajax-users2', [AjaxUser2Controller::class, 'store'])->name('ajax-users2.store');
});