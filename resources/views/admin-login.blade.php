<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/cce5ebab8a.js" crossorigin="anonymous"></script>
    <title>Login Admin | bvcklesmiggle</title>
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
            <div>
                <img src="img/home.png" alt="" class="h-auto max-w-52 mb-5 block mx-auto">
                <h1 class="text-light font-bold text-2xl mb-4">Welcome Back, Admin!</h1>
                <form method="POST" action="{{ route('login-admin') }}" class="flex flex-col gap-5">
                    @csrf
                    @error('login-admin')
                        <div class="w-full rounded-lg px-3 py-2 border border-red-500 bg-red-950/50 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    <div>
                        <label class="block mb-2 text-gray-300" for="username">Username</label>
                        <input required autocomplete="off" type="text" name="username" id="username" placeholder="Enter your username"
                            class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300" for="password">Password</label>
                        <input required autocomplete="off" type="password" name="password" id="password" placeholder="Enter your password"
                            class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="w-full py-2 bg-primary rounded-lg border-2 border-black shadow-[-6px_6px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition"><a
                                href="{{ route('admin-products') }}"
                                class="font-bold text-lg text-white">Login</a></button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
