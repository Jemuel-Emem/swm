<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SWM</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: url('{{ asset("images/lucenabg.jpg") }}') no-repeat center center fixed;
                background-size: cover;
            }

            .overlay {
                background-color: rgba(255, 255, 255, 0.85);
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            }

            .logo-container img {
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                border-radius: 50%;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="logo-container mb-6">
                <a href="/" wire:navigate>
                    <img src="{{ asset('images/lucenalogo.png') }}" alt="Lucena Logo" class="w-28 h-28 rounded-full">
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 overlay">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
