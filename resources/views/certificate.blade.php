<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Certificate</title>
</head>

<body class="">

    <div class="flex justify-between w-200 ml-10">
        <a class="m-10 text-green-500 font-bold" href="/">Back</a>

        <a class="m-10 text-green-500 font-bold" href="/download-certificate">Download</a>
    </div>
    <div class="w-200 border-4 mt-10 bg-gray-100 border-indigo-900 p-10 m-10 text-center">

        <h1 class="text-5xl flex justify-center ">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="green">
                <path d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z" />
            </svg>

            <span>
                Certificate of Complition!
            </span>
        </h1>
        <p class="text-2xl mt-5">This is to Clarify that</p>

        <h2 class="text-4xl">{{ $data['name'] }}</h2>
        <p class="text-2xl mt-5">Has Successfully Complited The</p>

        <h3 class="text-3xl">{{ $data['quiz'] }}</h3>
        <p class="text-2xl mt-5">{{ date('y-m-d') }}</p>
    </div>
</body>

</html>
