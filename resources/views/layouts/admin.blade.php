<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Dimsum BOS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                            950: '#450a0a'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full bg-gray-50" x-data="{ sidebarOpen: false }">
    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
        @click="sidebarOpen = false">
    </div>

    <!-- Fixed Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-maroon-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 bg-maroon-950 flex-shrink-0">
                <h1 class="text-xl font-bold text-white">Dimsum BOS</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Dashboard - Available for all -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                          {{ request()->routeIs('admin.dashboard') ? 'bg-maroon-800' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>

                @if (auth()->user()->isSuperAdmin())
                    <!-- Super Admin Only Menu -->
                    <div class="pt-4">
                        <p class="px-4 text-xs font-semibold text-maroon-300 uppercase tracking-wider">Super Admin</p>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.cabang.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.cabang.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Kelola Cabang
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.users.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Kelola Admin
                            </a>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <!-- Admin Menu -->
                    <div class="pt-4">
                        <p class="px-4 text-xs font-semibold text-maroon-300 uppercase tracking-wider">Admin</p>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.umpan-balik.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.umpan-balik.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Kelola Umpan Balik
                            </a>

                            <a href="{{ route('admin.kategori.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.kategori.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                Kelola Kategori
                            </a>

                            <a href="{{ route('admin.pertanyaan.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.pertanyaan.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Kelola Pertanyaan
                            </a>

                            <a href="{{ route('admin.laporan.index') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium text-white rounded-lg hover:bg-maroon-800 transition-colors duration-200
                                      {{ request()->routeIs('admin.laporan.*') ? 'bg-maroon-800' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Laporan CSI
                            </a>
                        </div>
                    </div>
                @endif
            </nav>
        </div>
    </div>

    <!-- Main content wrapper -->
    <div class="lg:ml-64">
        <!-- Fixed Top Navigation -->
        <div class="fixed top-0 right-0 z-30 lg:left-64 left-0 h-16 bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center justify-between h-full px-4 lg:px-6">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-maroon-500 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                <!-- Welcome Text (optional, only show on larger screens) -->
                <div class="flex-1">
                    <span class="text-sm text-gray-500 hidden lg:block">
                        Selamat datang kembali, {{ auth()->user()->name }}!
                    </span>
                </div>

                <!-- Profile Dropdown - Always at the far right -->
                <div class="relative ml-auto" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-maroon-500"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <div class="w-8 h-8 bg-maroon-600 rounded-full flex items-center justify-center">
                            <span
                                class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span
                            class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">{{ auth()->user()->name }}</span>
                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                        tabindex="-1">

                        <!-- Profile Info -->
                        <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ auth()->user()->isSuperAdmin() ? 'Super Admin' : 'Administrator' }}
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <a href="{{ route('admin.profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                            tabindex="-1">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profil
                        </a>

                        <a href="{{ route('home') }}" target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                            tabindex="-1">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                </path>
                            </svg>
                            Lihat Website
                        </a>

                        <div class="border-t border-gray-200"></div>

                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                role="menuitem" tabindex="-1">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <main class="mt-16 p-4 lg:p-6 bg-gray-50 min-h-screen">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>
