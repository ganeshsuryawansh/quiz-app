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
            <h1 class="text-2xl text-blue-500">All Current Quiz's MCQ's</h1>

            <ul class="border border-gray-200">

                <li class="p-2 font-bold">
                    <ul class="flex justify-between">
                        <li class="w-30">MCQ Id</li>
                        <li class="w-70">Question</li>
                    </ul>
                </li>

                @foreach($mcqs as $mq)
                <li class="even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-30">{{$mq->id}}</li>
                        <li class="w-70">{{$mq->question}}</li>
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>

</html>
