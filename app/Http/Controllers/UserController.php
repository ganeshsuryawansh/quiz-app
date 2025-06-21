<?php

namespace App\Http\Controllers;

use App\Mail\UserForgotPassword;
use App\Mail\VerifyUser;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\MCQ_Records;
use App\Models\quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Browsershot\Browsershot;

class UserController extends Controller
{
    function welcome()
    {
        $category = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->take(5)->get();

        $quizData = quiz::withCount('record')->orderBy('record_count', 'desc')->take(5)->get();

        return view('welcome', ['categories' => $category, 'quizData' => $quizData]);
    }

    function categories()
    {
        $category = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->paginate(5);

        return view('categories-list', ['categories' => $category]);
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

        $link = Crypt::encryptString($user->email);
        $link = url('/verify-user/' . $link);

        Mail::to($user->email)->send(new VerifyUser($link, 'Verify Your Email'));

        if (!$user) {
            return "Something Went Wrong!";
        }

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {

                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url)->with('success', 'Please verify your email to start the quiz.');
            } else {
                return redirect('/')->with('success', 'Please verify your email to start the quiz.');
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

        if (empty($user) || !Hash::check($request->password, $user->password)) {
            return redirect('user-login')->with('error-msg', 'Invalid email or password.');
        }

        if (!empty($user)) {
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
            $resultData = MCQ_Records::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();

            $correctCount = MCQ_Records::where([
                ['record_id', '=', $currentQuiz['recordId']],
                ['is_correct', '=', 1]
            ])->count();

            $record = Record::find($currentQuiz['recordId']);

            if (!empty($record)) {
                $record->status = 2; // 2 for completed
                $record->update();
            }

            return view('quiz-result', ['resultData' => $resultData, 'correctans' => $correctCount]);
        }
    }


    function userDetails()
    {
        $record = Record::WithQuiz()->where('user_id', Session::get('user')->id)->get();
        return view('user-details', ['quizRecords' => $record]);
    }

    function searchQuiz(Request $request)
    {
        $quizData = quiz::withCount('Mcq')->where('name', 'like', '%' . $request->search . '%')->get();
        return view('quiz-search', [
            'quizData' => $quizData,
            'search' => $request->search
        ]);
    }

    function verifyUser($email)
    {
        $orgemail = Crypt::decryptString($email);
        $user = User::where('email', $orgemail)->first();

        if (!empty($user)) {
            $user->active = 2;

            if ($user->save()) {
                return redirect('/')->with('success', 'Your email has been verified successfully! You can now login.');
            } else {
                return redirect('/')->with('error', 'Email verification failed. Please try again.');
            }
        }
    }

    function ForgotUserPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url('/user-forgot-password/' . $link);

        Mail::to($request->email)->send(new UserForgotPassword($link));

        return redirect('/')->with('success', 'A password reset link has been sent to your email address.');
    }
    function userResetForgotPassword($email)
    {
        $orgemail = Crypt::decryptString($email);

        return view('user-set-forgot-password', ['email' => $orgemail]);
    }

    function UserSetPassword(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect('user-login')->with('success', 'Your password has been reset successfully! You can now login.');
            }
        }
    }

    function certificate()
    {
        $data = [];
        $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user')['name'];

        return view('certificate', ['data' => $data]);
    }

    function downloadCertificate()
    {
        $data = [];
        $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user')['name'];

        $html = view('download-certificate', ['data' => $data])->render();

        return response(
            Browsershot::html($html)
                ->setOption('args', ['--disable-web-security'])
                ->pdf()
        )->header(
            'Content-Disposition',
            'attachment; filename="certificate.pdf"'
        );
    }
}
