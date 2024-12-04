<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-hidden ">
    <div class="fixed top-0 right-0 bottom-0 left-0 bg-gradient-to-t from-green-400 to-white ">
        <img src="{{ asset('images/pic2.png') }}" class="object-cover h-full w-full opacity-15" alt="">
    </div>
    <section class="relative overflow-hidden ">
        <div class="px-8 py-32 mx-auto md:px-12 lg:px-24 max-w-7xl relative">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                <div>
                    <p class="text-sm leading-normal font-bold uppercase text-accent-600">
                        Tagline
                    </p>
                    <h2
                        class="text-xl leading-tight tracking-tight sm:text-2xl md:text-3xl lg:text-5xl mt-4 font-semibold text-base-900">
                        SOLID WASTE MANAGEMENT
                    </h2>
                    <p class="text-base leading-normal mt-4 text-base-500 font-medium">
                        "Better Environment, Better Tommorow Save The Planet"
                    </p>
                    <div class="flex flex-wrap items-center gap-2 mx-auto mt-8">

                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center transition-all duration-200 focus:ring-2 focus:outline-none text-white bg-green-600 hover:text-accent-500 ring-1 ring-base-200 focus:ring-accent-500 h-9 px-4 py-2 text-sm font-medium rounded-md">
                            Get Started
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="  h-[40rem]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61957.17288770317!2d121.58253447031608!3d13.939345291607582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd4b55c190e5ab%3A0x64e160af79331810!2sLucena%20City%2C%20Quezon!5e0!3m2!1sen!2sph!4v1733294069676!5m2!1sen!2sph"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            class="h-full w-full" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>

</html>
