<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function welcome()
    {
        return $category = Category::get();
        return view('welcome');
    }
}
