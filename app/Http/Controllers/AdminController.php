<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\quiz;
use App\Models\User;
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
            $users = User::orderBy('id', 'desc')->paginate(10);

            return view('admin', ['name' => $admin->name, 'users' => $users]);
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

        $totalMcqs = 0;

        if ($admin) {
            $quizName = request('quiz');
            $cateid = request('category_id');

            if (!empty($quizName) && !empty($cateid) && !Session::has('quizDetails')) {
                $quiz = new quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $cateid;

                if ($quiz->save()) {
                    Session::put('quizDetails', $quiz);
                }
            } else {
                $quiz = Session::get('quizDetails');

                if (isset($quiz->id)) {
                    $totalMcqs = Mcq::where('quiz_id', $quiz->id)->count();
                }
            }

            return view('add-quiz', ['name' => $admin->name, 'categories' => $categories, 'totalMcqs' => $totalMcqs]);
        } else {
            return redirect('admin-login');
        }
    }

    function addMCQs(Request $request)
    {
        $request->validate([
            "question" => "required|min:5",
            "a" => "required",
            "b" => "required",
            "c" => "required",
            "d" => "required",
            "correct_ans" => "required"
        ]);

        $mcq = new Mcq();
        $quiz = Session::get('quizDetails');
        $admin = Session::get('admin');

        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->correct_ans = $request->correct_ans;
        $mcq->admin_id = $admin->id;
        $mcq->quiz_id = $quiz->id;
        $mcq->category_id = $quiz->category_id;

        if ($mcq->save()) {

            if ($request->submit == "add-more") {
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect('/admin-categories');
            }
        }
    }

    function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect("/admin-categories");
    }

    function showQuiz($id, $quizName)
    {
        $admin = Session::get('admin');
        $mcqs = Mcq::where('quiz_id', $id)->get();

        if ($admin) {
            return view('show-quiz', ['name' => $admin->name, 'mcqs' => $mcqs, 'quizName' => $quizName]);
        } else {
            return redirect('admin-login');
        }
    }

    function quizList($id, $category)
    {
        $admin = Session::get('admin');
        $quizData = quiz::where('category_id', $id)->get();

        if ($admin) {
            return view('quiz-list', ['name' => $admin->name, 'quizData' => $quizData, 'category' => $category]);
        } else {
            return redirect('admin-login');
        }
    }
}
