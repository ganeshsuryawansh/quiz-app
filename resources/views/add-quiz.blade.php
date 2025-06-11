<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Add Quiz</title>
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

        <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">

            @if (!session('quizDetails'))

            <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Quiz</h2>

            <form action="/add-quiz" method="get" class="space-y-4">
                <div>
                    <input type="text" placeholder="Enter Quiz name" name="quiz" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">

                    <br>
                    <br>

                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        @foreach ($categories as $c )
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Add</button>
            </form>

            @else
            <span class="text-green-500 font-bold text-center w-full">Quiz: {{ session('quizDetails')->name }}</span>
            <p class="text-green-500 font-bold">
                Total MCQs: {{ $totalMcqs }}

                @if ($totalMcqs>0)
                <a class="text-yellow-500 text-sm" href="">Show MCQs</a>
                @endif
            </p>

            <h1 class="text-2xl text-center text-gray-800 mb-6">Add MCQs</h1>

            <form action="add-mcq" method="post" class="space-y-4">
                @csrf

                <div>
                    <textarea type="text" placeholder="Enter Question" name="question" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    </textarea>

                    @error('question')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <div>
                    <input type="text" placeholder="Enter first Option" name="a" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('a')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <div>
                    <input type="text" placeholder="Enter Second Option" name="b" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('b')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <div>
                    <input type="text" placeholder="Enter Third Option" name="c" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('c')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <div>
                    <input type="text" placeholder="Enter Fourth Option" name="d" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('d')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <div>
                    <select name="correct_ans" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        <option value="">Select Correct Answer!</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                    @error('correct_ans')
                    <div class="text-red-700">{{ $message }}*</div>
                    @enderror
                </div>

                <button type="submit" name="submit" value="add-more" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Add More</button>

                <button type="submit" name="submit" value="done" class="w-full bg-green-500 rounded-xl px-4 py-2 text-white">Add & Submit</button>

                <a href="/end-quiz" class="w-full block text-center bg-red-500 rounded-xl px-4 py-2 text-white">Finish Quiz</a>
            </form>

            @endif

        </div>

    </div>
</body>

</html>
