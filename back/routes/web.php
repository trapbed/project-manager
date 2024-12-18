<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/tasks', [TaskController::class, 'all_tasks'])->name('tasks');
Route::post('/page_tasks', [TaskController::class, 'get_tasks_on_page'])->name('page_tasks');
Route::post('/oneDescTask', [TaskController::class, 'one_task_more'])->name('one_task_more');

Route::post('/get_info_form_create_task', [TaskController::class, 'get_info_form_create_task'])->name('get_info_form_create_task');
Route::post('/save_create_task', [TaskController::class, 'save_create_task'])->name('save_create_task');
Route::post('/get_info_to_edit_task', [TaskController::class, 'get_info_to_edit_task'])->name('get_info_to_edit_task');
Route::post('/update_task', [TaskController::class, 'update_task'])->name('update_task');
Route::post('/delete_task', [TaskController::class, 'delete_task'])->name('delete_task');
Route::get('/tasks_manager', [ProjectController::class, 'tasks_manager'])->name('tasks_manager');

Route::post('/tasks_worker', [TaskController::class, 'tasks_worker']);
Route::post('/get_comments_for_task', [TaskController::class, 'get_comments_for_task']);
Route::post('/create_comm', [TaskController::class, 'create_comm']);
Route::post('/delete_comment', [TaskController::class, 'delete_comment']);
Route::post('/see_more_task_worker', [TaskController::class, 'see_more_task_worker']);
Route::post('/change_status', [TaskController::class, 'change_status']);


Route::post('/manager_p', [TaskController::class, 'get_manager_of_project'])->name('manager_p');
Route::post('/projects', [ProjectController::class, 'all_projects'])->name('projects');
Route::post('/page_projects',[ProjectController::class, 'get_projects_on_page'])->name('page_projects');
Route::post('/one_project', [ProjectController::class, 'get_info_one_project'])->name('one_project');
Route::post('/update_squad', [ProjectController::class, 'update_squad'])->name('update_squad');
Route::post('/save_update_squad', [ProjectController::class, 'save_update_squad'])->name('save_update_squad');
Route::post('/delete_from_squad', [ProjectController::class, 'delete_from_squad'])->name('delete_from_squad');
Route::post('/get_projects_title', [ProjectController::class, 'get_projects_title'])->name('get_projects_title');


Route::post('/projects_info_admin', [ProjectController::class, 'projects_info_admin'])->name('projects_info_admin');
Route::post('/update_project_info', [ProjectController::class, 'update_project_info'])->name('update_project_info');
Route::post('/save_update_proj', [ProjectController::class, 'save_update_proj'])->name('save_update_proj');
Route::post('/delete_project', [ProjectController::class, 'delete_project'])->name('delete_project');
Route::post('/create_proj_modal_info', [ProjectController::class, 'create_proj_modal_info']);
Route::post('/save_created_project', [ProjectController::class, 'save_created_project']);


Route::post('/users', [UserController::class, 'all_users'])->name('users');
Route::post('/blocked_user', [UserController::class, 'blocked_user'])->name('blocked_user');


Route::post('/create_user', [UserController::class, 'create_user'])->name('create_user');


Route::post('/get_data_for_report', [ReportController::class, 'get_data_for_report']);
Route::post('/get_data_to_create_report', [ReportController::class, 'get_data_to_create_report']);
Route::post('/create_report', [ReportController::class, 'create_report']);
Route::post('/get_reports', [ReportController::class, 'get_reports']);
Route::post('/get_info_one_rep', [ReportController::class, 'get_info_one_rep']);
// Route::group(['middleware'=>['auth']], function(){
//     Route::group(['middleware'=>['admin']], function(){
//     });
// });
