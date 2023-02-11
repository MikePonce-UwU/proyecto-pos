<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoryController;
use App\Http\Livewire\PermissionAssignController;
use App\Http\Livewire\PermissionController;
use App\Http\Livewire\RoleController;
use App\Http\Livewire\UserController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // admin
    Route::get('roles', RoleController::class)->name('roles.index')->middleware('role:Admin');
    Route::get('permissions', PermissionController::class)->name('permissions.index')->middleware('role:Admin');
    Route::get('users', UserController::class)->name('users.index')->middleware('role:Admin');
    Route::get('permission_assign', PermissionAssignController::class)->name('permission_assign.index')->middleware('role:Admin');

    Route::get('categories', CategoryController::class)->name('categories.index');
});
