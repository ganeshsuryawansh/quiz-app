<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Quiz List</title>
</head>

<body>
    <x-user-navbar></x-navbar>
        @if(session('category'))
        <div class=" bg-green-800 text-white pl-5">{{session('category')}}</div>
        @endif
        <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

            <div class="w-200">
                <h1 class="text-2xl text-green-800 my-3 font-bold">Category Name: {{ $category }}
                </h1>

                <ul class="border border-gray-200">

                    <li class="p-2 font-bold">
                        <ul class="flex justify-between">
                            <li class="w-30">Quiz Id</li>
                            <li class="w-70">Name</li>
                            <li class="w-70">Mcq Count</li>
                            <li class="w-70">Action</li>
                        </ul>
                    </li>

                    @foreach($quizData as $qd)
                    <li class="even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{$qd->id}}</li>
                            <li class="w-70">{{$qd->name}}</li>
                            <li class="w-70">{{$qd->mcq_count}}</li>
                            <li class="w-70">
                                <a href="/start-quiz/{{ $qd->id }}/{{$qd->name}}" class="text-green-800 font-bold">
                                    Attempt Quiz
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
</body>

</html>
