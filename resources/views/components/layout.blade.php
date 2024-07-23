<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/cce5ebab8a.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="{{ asset('css/global.css') }}"> --}}
    <title>bvcklesmiggle</title>
</head>
<body class="bg-[#343434]">
    <x-header />
    <x-navbar></x-navbar>
    {{ $slot }}
</body>
</html>