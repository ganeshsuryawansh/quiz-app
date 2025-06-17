<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Admin
Route::view('admin-login', 'admin-login');
Route::post('login', [AdminController::class, 'login']);

Route::get('dashboard', [AdminController::class, 'dashboard']);
Route::get('admin-categories', [AdminController::class, 'categories']);
Route::get('admin-logout', [AdminController::class, 'logout']);
Route::post('add-category', [AdminController::class, 'addCategoris']);
Route::get('category/delete/{id}', [AdminController::class, 'deleteCategory']);

Route::get('add-quiz', [AdminController::class, 'addQuiz']);
Route::post('add-mcq', [AdminController::class, 'addMCQs']);
Route::get('end-quiz', [AdminController::class, 'endQuiz']);
Route::get('show-quiz/{id}/{name}', [AdminController::class, 'showQuiz']);
Route::get('quiz-list/{id}/{category}', [AdminController::class, 'quizList']);

// User
Route::get('/', [UserController::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [UserController::class, 'userquizList']);
Route::view('user-signup', 'user-signup');
Route::post('user-signup', [UserController::class, 'userSignup']);
Route::get('start-quiz/{id}/{name}', [UserController::class, 'startQuiz']);
Route::get('user-logout', [UserController::class, 'userLogout']);
Route::get('user-signup-quiz', [UserController::class, 'userSignupQuiz']);
Route::view('user-login', 'user-login');
Route::post('user-login', [UserController::class, 'userLogin']);
Route::get('user-login-quiz', [UserController::class, 'userLoginQuiz']);
Route::get('mcq/{id}/{name}', [UserController::class, 'mcq']);
