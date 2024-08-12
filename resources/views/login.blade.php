<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/cce5ebab8a.js" crossorigin="anonymous"></script>
    <title>bvcklesmiggle | Login</title>
</head>
{{-- <body class="bg-fixed"> --}}

<body class="bg-fixed h-screen">
    {{-- <nav id="header" class="flex justify-between items-center max-container padding-container pt-4 fixed top-0">
        <img src="img/logo.png" alt="" class="h-auto max-w-52">
        <div class="leading-none grow text-end">
            <h4 class="font-bold font-segoe text-gray-200">Bvck<br>Yourself!</h4>
        </div>
    </nav> --}}

    <main class="h-full flexCenter">
        <div class="w-1/2 padding-container h-full flexCenter">
            <div cl>
                <img src="img/home.png" alt="" class="h-auto max-w-52 mb-5 block mx-auto">
                <h1 class="text-light font-bold text-2xl mb-4">Welcome Back, Admin!</h1>
                <form action="" class="flex flex-col gap-5">
                    <div>
                        <label class="block mb-2 text-gray-300" for="username">Username</label>
                        <input required type="text" name="username" id="username" placeholder="Enter your username"
                            class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200 bg-transparent">
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300" for="password">Password</label>
                        <input required type="password" name="password" id="password" placeholder="Enter your password"
                            class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200 bg-transparent">
                    </div>
                    <div class="mt-4">
                        {{-- <button class="w-full bg-primary text-light rounded">Login</button> --}}
                        <button
                            class="w-full py-2 bg-primary rounded-lg border-2 border-black shadow-[-6px_6px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition"><a
                                href="articles" class="font-bold text-lg text-white">Login</a></button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- <div class="border border-gray-500 p-5 rounded-2xl">
    <img src="img/logo.png" alt="" class="h-auto max-w-64 mb-5">
    <h1 class="font-bold text-xl text-light mb-8">Login</h1>
    <form action="">
      <label class="block mb-1 text-light" for="username">Username</label>
      <input type="text" name="username" id="username" placeholder="Enter your username" class="w-full rounded-xl px-3 py-2 border border-gray-500 text-gray-200 bg-transparent">
    </form>
  </div> --}}

</body>

</html>
