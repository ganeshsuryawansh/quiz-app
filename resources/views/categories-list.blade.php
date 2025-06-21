<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Quizz App Home Page</title>
</head>

<body>
    <x-user-navbar />

    <div class="flex flex-col min-h-screen items-center bg-gray-100">

        @if (session('success'))
        <div>
            <p class="text-green-500 font-bold">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div>
            <p class="text-red-500 font-bold">{{session('error')}}</p>
        </div>
        @endif


        <h1 class="text-3xl text-green-900 p-5">Check Your Skills</h1>
        <!-- top category -->
        <div class="w-full max-w-md">

            <div class="relative">
                <form action="search-quiz" method="get">
                    <input name="search" class="w-full px-4 py-5 text-gray-700 border border-gray-300 rounded-2xl shadow" type="text" placeholder="Search quiz...">

                    <button class="absolute right-2 top-4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="w-full">
                <h1 class="text-2xl text-blue-500 my-3 text-center">Top Category</h1>

                <ul class="border border-gray-200">

                    <li class="p-2 font-bold">
                        <ul class="flex justify-between">
                            <li class="w-30">S. No</li>
                            <li class="w-70">Name</li>
                            <li class="w-70">Quiz Count</li>
                            <li class="w-30">Action</li>
                        </ul>
                    </li>

                    @foreach($categories as $key => $category)

                    <li class="even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{$key+1}}</li>
                            <li class="w-70">{{$category->name}}</li>
                            <li class="w-70">{{$category->quizzes_count}}</li>
                            <li class="w-30 flex">
                                <a href="user-quiz-list/{{$category->id}}/{{str_replace(' ', '-', $category->name)}}" class="text-blue-800 font-bold mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @endforeach
                </ul>

                <div class="mt-3" >
                    {{$categories->links()}}
                </div>
            </div>

        </div>



    </div>

    <x-footer-user></x-footer-user>
</body>
