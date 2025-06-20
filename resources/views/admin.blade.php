<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Admin Dashboard</title>
</head>

<body>
    <x-navbar name="{{ $name }}" />


    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <div class="w-200">

            <h1 class="text-2xl text-blue-500">Users List</h1>

            <ul class="border border-gray-200">

                <li class="p-2 font-bold">
                    <ul class="flex justify-between">
                        <li class="w-30">S. No</li>
                        <li class="w-70">Name</li>
                        <li class="w-70">Email</li>
                    </ul>
                </li>

                @foreach($users as $u)
                <li class="even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-30">{{$u->id}}</li>
                        <li class="w-70">{{$u->name}}</li>
                        <li class="w-70">{{$u->email}}</li>
                    </ul>
                </li>
                @endforeach
            </ul>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>


</body>

</html>
