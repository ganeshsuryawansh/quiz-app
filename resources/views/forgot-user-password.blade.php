<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>User Login</title>
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-2xl mb-6">Forgot Password!</h2>

            <form action="/forgot-user-password" method="post" class="space-y-4">
                @csrf

                <div>
                    <input type="text" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none" placeholder="Enter User Email">
                    @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Login</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
