<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Category</title>
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
    @if(session('category'))
    <div class=" bg-green-800 text-white pl-5">{{session('category')}}</div>
    @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

        <div class="w-200">
            <h1 class="text-2xl text-blue-500 my-3">Category Name: {{ $category }}
                <a href="/add-quiz">Back</a>
            </h1>

            <ul class="border border-gray-200">

                <li class="p-2 font-bold">
                    <ul class="flex justify-between">
                        <li class="w-30">Quiz Id</li>
                        <li class="w-70">Name</li>
                        <li class="w-70">Action</li>
                    </ul>
                </li>

                @foreach($quizData as $qd)
                <li class="even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-30">{{$qd->id}}</li>
                        <li class="w-70">{{$qd->name}}</li>
                        <li class="w-70">

                            <a href="/show-quiz/{{ $qd->id }}/{{ $qd->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                </svg>
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
