<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasirku</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans text-gray-800">
   @extends('layouts.app')
    @section('content')
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="text-center bg-white shadow-xl rounded-2xl p-10 max-w-md w-full">
            <h1 class="text-3xl font-semibold mb-4">Halo👋</h1>
            <p class="text-gray-600 mb-8">Selamat datang di Kasirku. Silakan mulai aktivitas kasirmu.</p>

                    <div class="flex flex-col space-y-4">
            <a href="{{ route('login') }}"
            class="bg-primary hover:bg-blue-700 text-white py-2 px-4 rounded-xl text-lg font-medium transition duration-300 text-decoration-none">
                Login
            </a>
            <a href="{{ route('register') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-xl text-lg font-medium transition duration-300 text-decoration-none">
                Register
            </a>
        </div>
        </div>
    </div>
    @endsection

</body>
</html>
