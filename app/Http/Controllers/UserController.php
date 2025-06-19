<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\MCQ_Records;
use App\Models\quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


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
        $quizData = quiz::withCount('Mcq')->where('category_id', $id)->get();
        return view('user-quiz-list', ['quizData' => $quizData, 'category' => $category]);
    }

    function userSignup(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {

                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            }

            return redirect('/');
        }
    }

    function startQuiz($id, $name)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs = Mcq::where('quiz_id', $id)->get();

        Session::put('firstMCQ', $mcqs[0]);
        $quizName = $name;

        return view('start-quiz', ['quizName' => $quizName, 'quizCount' => $quizCount]);
    }

    function userLogout()
    {
        Session::forget('user');
        return redirect('/');
    }

    function userSignupQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }

    function userLogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || Hash::check($request->password, $user->password)) {
            return "User not Valid, Please check email and password!";
        }

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {

                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            }

            return redirect('/');
        }
    }

    function userLoginQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $name)
    {
        $record = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMCQ')->quiz_id;
        $record->status = 1;

        if ($record->save()) {

            $currentQuiz = [];
            $currentQuiz['totalMcq'] = Mcq::where('quiz_id', Session::get('firstMCQ')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = Session::get('firstMCQ')->quiz_id;
            $currentQuiz['recordId'] = $record->id;

            Session::put('currentQuiz', $currentQuiz);
            $mcqdata = Mcq::find($id);

            return view('mcq-page', data: ['quizName' => $name, "mcqdata" => $mcqdata]);
        } else {
            return "Something Went Wrong!";
        }
    }

    function SubmiAndNext(Request $request)
    {
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqdata = Mcq::where([['id', '>', $request->id], ['quiz_id', '=', $currentQuiz['quizId']]])->first();

        $isExists = MCQ_Records::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id]
        ])->count();

        if ($isExists < 1) {
            $mcq_record = new MCQ_Records();
            $mcq_record->record_id = $currentQuiz['recordId'];
            $mcq_record->user_id = Session::get('user')->id;
            $mcq_record->mcq_id = $request->id;
            $mcq_record->select_answer = $request->option;

            if ($request->option === Mcq::find($request->id)->correct_ans) {
                $mcq_record->is_correct = 1;
            } else {
                $mcq_record->is_correct = 0;
            }

            if (!$mcq_record->save()) {
                return "Something Went Wrong!";
            }
        }

        Session::put('currentQuiz', $currentQuiz);

        if (!empty($mcqdata)) {
            return view('mcq-page', data: ['quizName' => $currentQuiz['quizName'], "mcqdata" => $mcqdata]);
        } else {
            return $resultData = MCQ_Records::where('record_id', $currentQuiz['recordId'])->get();
            return "Result Page!";
        }
    }
}
