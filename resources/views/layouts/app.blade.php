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
        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen">
            <!-- Sidebar -->
            <div 
                x-show="sidebarOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed inset-0 z-10 lg:hidden"
                @click="sidebarOpen = false">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            </div>

            <div 
                :class="{'translate-x-0': sidebarOpen, '-translate-x-full lg:translate-x-0': !sidebarOpen}"
                class="fixed top-0 left-0 bottom-0 flex flex-col w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out z-30">
                <livewire:layout.navigation />
            </div>

            <!-- Page Content -->
            <main class="lg:pl-64">
                <!-- Page Heading -->
                <header class="bg-white border-b">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <!-- Botón de toggle para móvil -->
                            <button 
                                @click="sidebarOpen = !sidebarOpen" 
                                class="lg:hidden mr-4 text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            >
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                @yield('title', config('app.name'))
                            </h2>
                        </div>
                    </div>
                </header>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        @livewireScripts
    </body>
</html>
