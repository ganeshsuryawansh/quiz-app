<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\quiz;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function welcome()
    {
        $category = Category::withCount('quizzes')->get();
        // $category = Category::get();
        return view('welcome', ['categories' => $category]);
    }

    function userquizList($id, $category)
    {
        return $quizData = quiz::where('category_id', $id)->get();
        return view('quiz-list', ['quizData' => $quizData, 'category' => $category]);
    }
}
