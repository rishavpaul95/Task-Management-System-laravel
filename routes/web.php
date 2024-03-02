<?php

use App\Http\Controllers\AllTaskController;
use App\Http\Controllers\AssignTaskController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ViewTaskController;

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



Route::get('/', [Controller::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dash', [DashController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks/add', [TasksController::class, 'store']);
    Route::get('/tasks/delete/{id}', [TasksController::class, 'delete']);
    Route::post('/tasks/edit/{id}', [TasksController::class, 'edit']);



    // Trash Section

    // Route::get('/tasks/permadelete/{id}', [TasksController::class, 'forceddelete']);
    // Route::get('/tasks/restore/{id}', [TasksController::class, 'restore']);
    // Route::get('/tasks/trash', [TasksController::class, 'viewtrash']);


    Route::get('/viewtask/{id}', [ViewTaskController::class, 'show']);

    //View edit delete Task Board
    Route::get('/alltask',[AllTaskController::class, 'index']);
    Route::post('/alltask/edit/{id}',[AllTaskController::class, 'edit']);
    Route::get('/alltask/delete/{id}',[AllTaskController::class, 'delete']);


    //Assign task add edit delete
    Route::get('/admin/assigntask',[AssignTaskController::class, 'index']);
    Route::post('/admin/assigntask/add',[AssignTaskController::class, 'store']);
    Route::post('/admin/assigntask/edit/{id}',[AssignTaskController::class, 'edit']);
    Route::get('/admin/assigntask/delete/{id}',[AssignTaskController::class, 'delete']);


    //comment posting
    Route::post('/comment/{taskId}', [CommentController::class, 'store']);

    Route::middleware([
        'admin',
    ])->group(function () {

        Route::get('/admin/categories', [CategoriesController::class, 'index']);
        Route::post('/admin/categories/add', [CategoriesController::class, 'store']);
        Route::get('/admin/categories/delete/{id}', [CategoriesController::class, 'delete']);
        Route::post('/admin/categories/edit/{id}', [CategoriesController::class, 'edit']);

    });
});

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post_name}', [BlogController::class, 'show']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
