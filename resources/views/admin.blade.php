<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Dashboard</title>
</head>

<body>

    <nav class="bg-white shadow-md px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="text-2xl text-gray-700 hover:text-blue-500 cursor-pointer">
                Quiz APP
            </div>
            <div class="space-x-4">
                <a class="text-gray-700 hover:text-blue-500" href="">Categories</a>
                <a class="text-gray-700 hover:text-blue-500" href="">Quiz</a>
                <a class="text-gray-700 hover:text-blue-500" href="">Wellcome {{ $name }}</a>
                <a class="text-gray-700 hover:text-blue-500" href="">Logout</a>
            </div>
        </div>
    </nav>

</body>

</html>
