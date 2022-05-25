<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VideoController;

// use App\Http\Controllers\LockScreen;

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
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });

    // ----------------------------- home dashboard ------------------------------//
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ----------------------------- user input ------------------------------//
    Route::get('user/management', [UserManagementController::class, 'index'])->name('user/management');
    Route::get('user/add/new', [UserManagementController::class, 'addNew'])->name('user/add/new');
    Route::post('user/add/save', [UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
    Route::get('view/detail/{id}', [UserManagementController::class, 'viewDetail'])->middleware('auth');
    Route::post('update', [UserManagementController::class, 'update'])->name('update');
    Route::get('delete_user/{id}', [UserManagementController::class, 'delete'])->middleware('auth');

    // ----------------------------- form input -----------------------------//
    Route::get('form/information/new', [FormController::class, 'index'])->name('form/information/new');
    Route::post('form/information/save', [FormController::class, 'saveRecord'])->name('form/information/save');
    Route::get('form/information/show', [FormController::class, 'show'])->name('form/information/show');
    Route::get('form/information/detail/{id}', [FormController::class, 'viewEdit']);
    Route::post('form/information/update', [FormController::class, 'viewUpdate'])->name('form/information/update');
    Route::get('form/information/delete/{id}', [FormController::class, 'delete']);

    // ----------------------------- project input -----------------------------//
    Route::get('admin/project/new', [ProjectController::class, 'index'])->name('admin/project/new');
    Route::post('admin/project/save', [ProjectController::class, 'saveRecord'])->name('admin/project/save');
    Route::get('admin/project/show', [ProjectController::class, 'show'])->name('admin/project/show');
    Route::get('admin/project/detail/{id}', [ProjectController::class, 'viewEdit']);
    Route::post('admin/project/update', [ProjectController::class, 'update'])->name('admin/project/update');
    Route::get('admin/project/delete/{id}', [ProjectController::class, 'delete']);
    Route::get('admin/project/view/{id}', [ProjectController::class, 'viewEach']);

    Route::post('admin/project/show/search', [ProjectController::class, 'searchProject'])->name('admin/project/show/search');
    Route::post('admin/project/view/search', [ProjectController::class, 'searchEachProject'])->name('admin/project/view/search');

    // ----------------------------- task input -----------------------------//
    Route::get('admin/task/new', [TaskController::class, 'new'])->name('admin/task/new');
    Route::post('admin/task/save', [TaskController::class, 'saveRecord'])->name('admin/task/save');
    Route::get('admin/task/show', [TaskController::class, 'show'])->name('admin/task/show');
    Route::get('admin/task/me', [TaskController::class, 'myTask'])->name('admin/task/me');
    Route::get('admin/task/detail/{id}', [TaskController::class, 'viewEdit']);
    Route::post('admin/task/update', [TaskController::class, 'update'])->name('admin/task/update');
    Route::get('admin/task/delete/{id}', [TaskController::class, 'delete']);

    Route::post('admin/task/show/search', [TaskController::class, 'teamTask'])->name('admin/task/show/search');
    Route::post('admin/task/me/search', [TaskController::class, 'adminTask'])->name('admin/task/me/search');

    // ----------------------------- video input -----------------------------//
    Route::post('admin/video/save', [VideoController::class, 'saveVideo'])->name('admin/video/save');
    Route::get('admin/video/show', [VideoController::class, 'show'])->name('admin/video/show');
    Route::post('admin/video/update', [VideoController::class, 'update'])->name('admin/video/update');
    Route::get('admin/video/delete/{id}', [VideoController::class, 'delete']);

    // ----------------------------- quiz input -----------------------------//
    Route::post('admin/quiz/save', [QuizController::class, 'saveQuiz'])->name('admin/quiz/save');
    Route::get('admin/quiz/show', [QuizController::class, 'show'])->name('admin/quiz/show');
    Route::get('admin/quiz/detail/{id}', [QuizController::class, 'viewEdit']);
    Route::post('admin/quiz/update', [QuizController::class, 'update'])->name('admin/quiz/update');
    Route::get('admin/quiz/delete/{id}', [QuizController::class, 'delete']);

    // ----------------------------- Profile -----------------------------//
    Route::get('admin/profile/', [UserManagementController::class, 'showProfile'])->name('admin/profile');
    Route::get('admin/profile/detail/{id}', [UserManagementController::class, 'viewProfile']);
    Route::post('admin/profile/update', [UserManagementController::class, 'update'])->name('updateProfile');
    Route::get('admin/profile/changePassword/{id}', [UserManagementController::class, 'changePassword']);
    Route::post('admin/profile/updatePassword', [UserManagementController::class, 'updatePassword'])->name('updatePass');

    // ----------------------------- Client -----------------------------//
    Route::get('client/', [ClientController::class, 'index'])->name('client');
    Route::get('client/detail/', [ClientController::class, 'showProject']);
    Route::get('client/detail/{id}', [ClientController::class, 'viewProject']);
    Route::get('client/invoice/{id}', [ClientController::class, 'invoice']);
    Route::get('client/invoices/{id}', [ClientController::class, 'invoices']);
    Route::get('client/invoice/save/{id}', [ClientController::class, 'saveInvoice'])->name('saveInvoice');
    Route::get('client/profile/', [ClientController::class, 'showProfile'])->name('client/profile');
    Route::get('client/profile/detail/{id}', [ClientController::class, 'viewProfile']);
    Route::post('client/profile/update', [ClientController::class, 'updateProfile'])->name('client/update');
    Route::get('client/profile/changePassword/{id}', [ClientController::class, 'changePassword']);
    Route::post('client/profile/updatePassword', [ClientController::class, 'updatePassword'])->name('client/updatePass');

    // ----------------------------- Member -----------------------------//
    Route::get('member/', [MemberController::class, 'index'])->name('member');
    Route::get('member/task/', [MemberController::class, 'showTask'])->name('member/task');
    Route::get('member/task/new', [MemberController::class, 'newTask']);
    Route::post('member/task/save', [MemberController::class, 'saveTask']);
    Route::get('member/task/detail/{id}', [MemberController::class, 'viewTask']);
    Route::post('member/task/update', [MemberController::class, 'updateTask'])->name('member/task/update');
    Route::get('member/task/delete/{id}', [MemberController::class, 'deleteTask']);
    Route::get('member/project/', [MemberController::class, 'showProject']);
    Route::get('member/project/view/{id}', [MemberController::class, 'viewProject']);
    Route::get('member/profile/', [MemberController::class, 'showProfile'])->name('member/profile');
    Route::get('member/profile/detail/{id}', [MemberController::class, 'viewProfile']);
    Route::post('member/profile/update', [MemberController::class, 'updateProfile'])->name('member/update');
    Route::get('member/profile/changePassword/{id}', [MemberController::class, 'changePassword']);
    Route::post('member/profile/updatePassword', [MemberController::class, 'updatePassword'])->name('member/updatePass');

});

Auth::routes();

// -----------------------------login----------------------------------------//
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('/forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('/forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword']);

// ----------------------------- reset password -----------------------------//