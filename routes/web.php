<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllTaskController;
use App\Http\Controllers\AssignTaskController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashController;
use App\Http\Controllers\RegisterCompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewTaskController;
use App\Http\Controllers\SocialController;


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

Route::get('/register-company ', [RegisterCompanyController::class, 'index']);

// only authenticated users can access these routes
Route::middleware([
    'auth', 'verified'
])->group(function () {

    //Dashboard
    Route::get('/dash', [DashController::class, 'index']);

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Tasks
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks/add', [TasksController::class, 'store']);
    Route::get('/tasks/delete/{id}', [TasksController::class, 'delete']);
    Route::post('/tasks/edit/{id}', [TasksController::class, 'edit']);



    //View Task
    Route::get('/viewtask/{id}', [ViewTaskController::class, 'show']);

    //Task Board
    Route::get('/alltask', [AllTaskController::class, 'index']);
    Route::post('/alltask/edit/{id}', [AllTaskController::class, 'edit']);
    Route::get('/alltask/delete/{id}', [AllTaskController::class, 'delete']);


    //Assign task
    Route::group(['middleware' => ['can:assign_task']], function () {

        Route::get('/assigntask', [AssignTaskController::class, 'index']);
        Route::post('/assigntask/add', [AssignTaskController::class, 'store']);
        Route::post('/assigntask/edit/{id}', [AssignTaskController::class, 'edit']);
        Route::get('/assigntask/delete/{id}', [AssignTaskController::class, 'delete']);

    });

    //comment posting
    Route::post('/comment/{taskId}', [CommentController::class, 'store']);
    Route::get('/comment/delete/{id}', [CommentController::class, 'delete']);
});

Route::middleware([
    'role:admin', 'auth', 'verified'
])->group(function () {

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::post('/categories/add', [CategoriesController::class, 'store']);
    Route::get('/categories/delete/{id}', [CategoriesController::class, 'delete']);
    Route::post('/categories/edit/{id}', [CategoriesController::class, 'edit']);


    //Permissions
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('/permissions/add', [PermissionController::class, 'store']);
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'delete']);
    Route::post('/permissions/edit/{id}', [PermissionController::class, 'edit']);



    // Roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles/add', [RoleController::class, 'store']);
    Route::get('/roles/delete/{id}', [RoleController::class, 'delete']);
    Route::post('/roles/edit/{id}', [RoleController::class, 'edit']);
    Route::get('/roles/addpermission/{id}', [RoleController::class, 'addPermissionToRole']);
    Route::put('/roles/addpermission/{id}', [RoleController::class, 'storePermissionToRole']);

    // Users

    Route::resource('/users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);






    // Trash Section

    // Route::get('/tasks/permadelete/{id}', [TasksController::class, 'forceddelete']);
    // Route::get('/tasks/restore/{id}', [TasksController::class, 'restore']);
    // Route::get('/tasks/trash', [TasksController::class, 'viewtrash']);

});

// accessable to all
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post_name}', [BlogController::class, 'show']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);


// Social Auth
Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);



require __DIR__ . '/auth.php';
