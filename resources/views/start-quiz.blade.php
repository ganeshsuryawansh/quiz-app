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

        <h2 class="text-lg text-green-800 my-3 font-bold">This quiz contains {{ $quizCount }} Questions and no limit to attempt this quiz!</h2>

        <h2 class="text-2xl text-green-800 my-3 font-bold">Good Luck!</h2>


        <button class="bg-blue-500 rounded-md px-4 py-2 text-white">
            Login / Signup For Start Quiz!
        </button>
    </div>
</body>

</html>
