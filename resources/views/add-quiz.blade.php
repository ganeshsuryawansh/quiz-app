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

            <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Quiz</h2>

            <form action="/add-quiz" method="get" class="space-y-4">
                <div>
                    <input type="text" placeholder="Enter Quiz name" name="quiz" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">

                    <br>
                    <br>

                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        @foreach ($categories as $c )
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Add</button>
            </form>

        </div>

    </div>
</body>

</html>
