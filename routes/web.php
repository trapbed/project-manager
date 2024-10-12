<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {return view('welcome');
// });
Route::get('/', function(){ return view('index'); });
Route::get('/account', function(){ return view('signin_show'); })->name('index');

