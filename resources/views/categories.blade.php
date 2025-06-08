<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Category</title>
</head>

<body>
    <x-navbar name="{{ $name }}" />

    @if(session('category'))
    <div class="bg-green-800 text-gray-300 px-5">{{session('category')}}</div>
    @endif

    <div class="bg-gray-100 flex justify-center pt-10">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-2xl mb-6">Add Category</h2>

            <form action="add-category" method="post" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="category" id="" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" placeholder="Enter Category">

                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Add</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
