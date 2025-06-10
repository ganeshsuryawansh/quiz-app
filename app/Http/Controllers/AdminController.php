<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class AdminController extends Controller
{
    function login(Request $request)
    {
        $validation = $request->validate(
            [
                "name" => "required",
                "password" => "required"
            ]
        );

        $admin = admin::where(
            ['name' => $request->name, 'password' => $request->password]
        )->first();

        if (!$admin) {
            $validation = $request->validate(
                [
                    "user" => "required"
                ],
                [
                    "user.required" => "User does not Exists!"
                ]
            );
        }

        Session::put('admin', $admin);
        return redirect('dashboard');
    }


    function dashboard()
    {
        $admin = Session::get('admin');

        if ($admin) {
            return view('admin', ['name' => $admin->name]);
        } else {
            return redirect('admin-login');
        }
    }

    function categories()
    {
        $categories = Category::get();
        $admin = Session::get('admin');

        if ($admin) {
            return view('categories', ['name' => $admin->name, 'categories' => $categories]);
        } else {
            return redirect('admin-login');
        }
    }

    function logout()
    {
        Session::forget('admin');
        return redirect('admin-login');
    }

    function addCategoris(Request $request)
    {
        $validation = $request->validate([
            'category' => "required | min:3 | unique:categories,name"
        ]);

        $admin = Session::get('admin');
        $category = new Category();

        $category->name = $request->category;
        $category->creator = $admin->name;

        if ($category->save()) {
            Session::flash('category', 'Category ' . $request->category . ' Added Successfully!');
        }

        return redirect('admin-categories');
    }

    function deleteCategory($id)
    {
        $isDeleted = Category::find($id)->delete();

        if ($isDeleted) {
            Session::flash('category', "Category Has Been Deleted Successfully!");
        }
        return redirect('admin-categories');
    }

    function addQuiz()
    {
        $categories = Category::get();
        $admin = Session::get('admin');

        if ($admin) {
            return view('add-quiz', ['name' => $admin->name, 'categories' => $categories]);
        } else {
            return redirect('admin-login');
        }
    }
}
