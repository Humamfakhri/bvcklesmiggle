<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/cce5ebab8a.js" crossorigin="anonymous"></script>
    <title>Admin | bvcklesmiggle</title>
</head>
{{-- <body class="bg-fixed"> --}}

<body class="bg-fixed">
    {{-- <nav id="header" class="flex justify-between items-center max-container padding-container pt-4 fixed top-0">
        <img src="img/logo.png" alt="" class="h-auto max-w-52">
        <div class="leading-none grow text-end">
            <h4 class="font-bold font-segoe text-gray-200">Bvck<br>Yourself!</h4>
        </div>
    </nav> --}}

    <main class="h-full flexCenter">
        <div class="w-full lg:w-1/2 max-w-lg padding-container h-full flexCenter">
            <div class="w-full">
                <div><img src="img/home.png" alt="" class="h-auto max-w-52 mb-5 block mx-auto"></div>
                <h1 class="text-light text-center font-bold text-2xl mb-4">Register</h1>
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3 md:gap-5">
                    @csrf
                    @error('register')
                        <div class="w-full rounded-lg px-3 py-2 border border-red-500 bg-red-950/50 text-red-500 text-sm">
                            {{ $message }}</div>
                    @enderror
                    <div>
                        <label class="block mb-2 text-gray-300" for="name">Name</label>
                        <input required autocomplete="off" type="text" name="name" id="name"
                            placeholder="Enter your name" value="{{ old('name') }}"
                            class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                        <div class="w-full">
                            <label class="block mb-2 text-gray-300" for="username">Username</label>
                            <input required autocomplete="off" type="text" name="username" id="username"
                                placeholder="Enter your username" value="{{ old('username') }}"
                                class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                            @error('username')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-gray-300" for="email">Email</label>
                            <input required autocomplete="off" type="email" name="email" id="email"
                                placeholder="Enter your email" value="{{ old('email') }}"
                                class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                        <div class="w-full">
                            <label class="block mb-2 text-gray-300" for="password">Password</label>
                            <input required autocomplete="off" type="password" name="password" id="password"
                                placeholder="Enter your password" value="{{ old('password') }}"
                                class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-gray-300" for="password_confirmation">Confirm Password</label>
                            <input required autocomplete="off" type="password" name="password_confirmation"
                                id="password_confirmation" placeholder="Re-enter your password"
                                value="{{ old('password') }}"
                                class="w-full rounded-lg px-3 py-2 bg-dark border border-gray-500 text-gray-200">
                            @error('password_confirmation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="w-full py-2 bg-primary rounded-lg border-2 border-black shadow-[-6px_6px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition"><a
                                href="{{ route('admin-products') }}"
                                class="font-bold text-lg text-white">Register</a></button>
                    </div>
                </form>
                <div class="my-5 text-center">
                    <small class="text-gray-400">Already have an account? <a href="{{ route('loginForm') }}"
                            class="text-white">Login</a></small>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
