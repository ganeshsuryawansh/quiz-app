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
        <h1 class="text-3xl text-green-900 p-5">Check Your Skills</h1>

        <div class="w-full max-w-md">
            <div class="relative">
                <input class="w-full px-4 py-5 text-gray-700 border border-gray-300 rounded-2xl shadow" type="text" placeholder="Search quiz...">

                <button class="absolute right-2 top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</body>
