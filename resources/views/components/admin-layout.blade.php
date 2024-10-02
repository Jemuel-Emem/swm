<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MINDBREAKER - Solid Waste Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none;
        }

        .bg-green-gradient {
            background: linear-gradient(90deg, rgba(34, 193, 195, 1) 0%, rgba(45, 253, 151, 1) 100%);
        }

        /* Logout button at the bottom of sidebar */
        .sidebar-footer {
            margin-top: auto;
        }

        /* Hover effect for logout button */
        .hover-logout:hover {
            background-color: #28a745;
            color: white;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-notifications position="top-right" />
    <x-dialog z-index="z-50" blur="md" align="center" />

    <!-- Sidebar -->
    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-green-600 flex flex-col">
        <div class="h-full px-3 py-4 overflow-y-auto flex flex-col">
            <!-- Logo and Title -->
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/lucenalogo.png') }}" alt="SWM Logo" class="w-20 h-20">
                <h1 class="text-white text-2xl font-bold mt-2">SWM</h1>
            </div>

            <!-- Navigation Links -->
            <ul class="space-y-6 mt-8">
                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:bg-white hover:text-green-600 rounded-lg">
                        <i class="ri-home-4-line"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:bg-white hover:text-green-600 rounded-lg">
                        <i class="ri-file-list-3-line"></i>
                        <span class="ml-3">Complaints</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center p-2 text-white hover:bg-white hover:text-green-600 rounded-lg">
                        <i class="ri-bar-chart-box-line"></i>
                        <span class="ml-3">Reports</span>
                    </a>
                </li>
            </ul>

            <!-- Logout button positioned at the bottom -->
            <div class="sidebar-footer mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full py-2 px-3 text-white font-bold bg-green-700 rounded-lg hover-logout">
                        <i class="ri-logout-box-r-line"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-6 sm:ml-64">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
