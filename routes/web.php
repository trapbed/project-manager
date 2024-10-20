<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){return view('index');})->name('');

Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('tasks', [TaskController::class, 'all_tasks'])->name('tasks');
Route::get('users', [UserController::class, 'all_users'])->name('users');
Route::get('tasks', [TaskController::class, 'all_tasks'])->name('tasks');

Route::get('projects', [ProjectController::class, 'all_projects'])->name('project');

// Route::post('projects', [ProjectController::class, 'manager_projects'])->name('manager_projects');