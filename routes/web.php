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
