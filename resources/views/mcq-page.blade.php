<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Quiz List</title>
</head>

<body>
    <x-user-navbar />

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

        <h1 class="text-2xl text-green-800 my-3 font-bold">{{ $quizName }}</h1>

        <h1 class="text-2xl text-green-800 my-3 font-bold">Question No. {{ session('currentQuiz')['totalMcq'] }}</h1>

        <h1 class="text-xl text-green-800 my-3 font-bold">{{ session('currentQuiz')['currentMcq'] }} of {{ session('currentQuiz')['totalMcq']}}</h1>

        <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140">
            <h3 class="text-green-900 font-bold text-xl mb-1">{{ $mcqdata->question }}</h3>

            <form action="/submit-next/{{ $mcqdata->id }}" method="post" class="space-y-4">

                @csrf

                <label for="option_1" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50">
                    <input id="option_1" class="form-radio text-blue-500" type="radio" name="option">
                    <span class="text-green-900 pl-2">{{ $mcqdata->a }}</span>
                </label>

                <label for="option_2" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50">
                    <input id="option_2" class="form-radio text-blue-500" type="radio" name="option">
                    <span class="text-green-900 pl-2">{{ $mcqdata->b }}</span>
                </label>

                <label for="option_3" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50">
                    <input id="option_3" class="form-radio text-blue-500" type="radio" name="option">
                    <span class="text-green-900 pl-2">{{ $mcqdata->c }}</span>
                </label>

                <label for="option_4" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50">
                    <input id="option_4 class=" form-radio text-blue-500" type="radio" name="option">
                    <span class="text-green-900 pl-2">{{ $mcqdata->d }}</span>
                </label>

                <button class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white my-3">Submit Answer And Next</button>

            </form>

        </div>
    </div>
    <x-footer-user />
</body>

</html>
