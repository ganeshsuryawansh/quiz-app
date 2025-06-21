<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>{{str_replace('-', ' ', $quizName)}}</title>
</head>

<body>
    <x-user-navbar />

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

        @if (session('success'))
        <div>
            <p class="text-green-500 font-bold">{{ session('success') }}</p>
        </div>
        @endif


        @if (session('error'))
        <div>
            <p class="text-red-500 font-bold">{{ session('error')}}</p>
        </div>
        @endif


        <h1 class="text-2xl text-green-800 my-3 font-bold">{{str_replace('-', ' ', $quizName)}}</h1>

        <h2 class="text-lg text-green-800 my-3 font-bold">This quiz contains {{ $quizCount }} Questions and no limit to attempt this quiz!</h2>

        <h2 class="text-2xl text-green-800 my-3 font-bold">Good Luck!</h2>

        @if(session('user'))
        <a href="/mcq/{{ session('firstMCQ')->id }}/{{ $quizName }}" class="bg-blue-500 text-white rounded-md px-4 py-2 my-5 text-xl">
            Start Quiz
        </a>
        @else
        <a href="/user-signup-quiz" class="bg-blue-500 rounded-md px-4 py-2 text-white">
            Signup For Start Quiz!
        </a>

        <br>

        <a href="/user-login-quiz" class="bg-blue-500 rounded-md px-4 py-2 text-white">
            Login For Start Quiz!
        </a>
        @endif
    </div>
</body>

</html>
