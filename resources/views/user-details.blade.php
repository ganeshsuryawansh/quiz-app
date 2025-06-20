<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>User Details Page</title>
</head>

<body>

    <x-user-navbar />

    <div class="flex flex-col min-h-screen items-center bg-gray-100">

        <h1 class="text-3xl text-green-900 p-5">Attempted Quiz!</h1>

        <div class="w-full max-w-md">


            <div class="w-full">

                <ul class="border border-gray-200">

                    <li class="p-2 font-bold">
                        <ul class="flex justify-between">
                            <li class="w-50">S. No</li>
                            <li class="w-100">Name</li>
                            <li class="w-100">Status</li>
                        </ul>
                    </li>

                    @foreach($quizRecords as $key => $qr)

                    <li class="even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-50">{{$key+1}}</li>
                            <li class="w-100">{{$qr->name}}</li>
                            <li class="w-50">
                                {{-- Display status based on the value of $qr->status --}}

                                @if($qr->status==2)
                                <span class="text-green-500">Compeleted</span>
                                @elseif($qr->status==1)
                                <span class="text-yellow-500">In Progress</span>
                                @else
                                <span class="text-red-500">Not Attempted</span>
                                @endif
                            </li>
                        </ul>
                    </li>

                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <x-footer-user></x-footer-user>
</body>
