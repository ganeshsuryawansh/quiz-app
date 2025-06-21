<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Category</title>
</head>

<body>
    <x-user-navbar />

    <div class="flex flex-col min-h-screen items-center bg-gray-100">

        <h1 class="text-3xl text-green-900 p-5">Quiz Result</h1>

        <div class="w-full max-w-md">
            <div class="w-full">

                @if($correctans*100/count($resultData) >= 70)
                <a href="/certificate" class="text-green-500 font-bold">View And Download Certificate</a>
                @endif

                <h1 class="text-2xl text-blue-500 my-3">{{ $correctans  }} out of {{ count($resultData) }} Correct!</h1>

                <ul class="border border-gray-200">

                    <li class="p-2 font-bold">
                        <ul class="flex justify-between">
                            <li class="w-30">S. No</li>
                            <li class="w-70">Selected Option</li>
                            <li class="w-70">Question</li>
                            <li class="w-70">Result</li>
                        </ul>
                    </li>

                    @foreach($resultData as $key => $res)

                    <li class="even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{$key+1}}</li>
                            <li class="w-70">{{$res->select_answer}}</li>
                            <li class="w-70">{{$res->question}}</li>

                            @if($res->is_correct)
                            <li class="w-70 text-green-500">Correct</li>
                            @else
                            <li class="w-70 text-red-500">Wrong</li>
                            @endif

                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <x-footer-user></x-footer-user>
</body>
