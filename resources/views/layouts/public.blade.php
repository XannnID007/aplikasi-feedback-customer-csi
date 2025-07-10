<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Umpan Balik') - Dimsum BOS</title>

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

<body class="h-full bg-gradient-to-br from-maroon-50 via-white to-orange-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Nav Links - Left Side -->
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <!-- Logo Image -->
                            <img src="{{ asset('images/dimsum.jpeg') }}" alt="Dimsum BOS Logo" class="h-10 w-auto mr-3">
                            <div>
                                <h1 class="text-xl font-bold text-maroon-900">Dimsum BOS</h1>
                                <p class="text-xs text-gray-600">Feedback System</p>
                            </div>
                        </a>
                    </div>

                    <!-- Nav Links -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}"
                            class="text-gray-700 hover:text-maroon-700 px-3 py-2 rounded-md text-sm font-medium transition-colors
                                  {{ request()->routeIs('home') ? 'text-maroon-700 bg-maroon-50' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('about') }}"
                            class="text-gray-700 hover:text-maroon-700 px-3 py-2 rounded-md text-sm font-medium transition-colors
                                  {{ request()->routeIs('about') ? 'text-maroon-700 bg-maroon-50' : '' }}">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                <!-- Login Button - Right Side -->
                <div class="flex items-center">
                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-maroon-700 text-white hover:bg-maroon-800 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Login Admin
                        </a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-gray-700 hover:text-maroon-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ auth()->user()->name }}
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Dashboard Admin</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="text-gray-700 hover:text-maroon-700 focus:outline-none focus:ring-2 focus:ring-maroon-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Mobile menu -->
                    <div x-show="open" x-transition
                        class="absolute top-16 right-4 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('home') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Beranda</a>
                        <a href="{{ route('about') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Tentang Kami</a>
                        @guest
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Login Admin</a>
                        @else
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Dashboard Admin</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-maroon-50">Logout</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main content -->
    <main class="flex-1">
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-maroon-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Dimsum BOS</h3>
                    <p class="text-maroon-300 text-sm">
                        Restoran dimsum terbaik dengan cita rasa autentik dan pelayanan berkualitas.
                        Kami menghargai setiap masukan dari pelanggan untuk terus meningkatkan layanan.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-sm text-maroon-300">
                        <p>📍 Jl. Raya Dimsum No. 123, Jakarta</p>
                        <p>📞 (021) 123-4567</p>
                        <p>✉️ info@dimsumbos.com</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Jam Operasional</h3>
                    <div class="space-y-2 text-sm text-maroon-300">
                        <p>Senin - Jumat: 10:00 - 22:00</p>
                        <p>Sabtu - Minggu: 09:00 - 23:00</p>
                        <p>Hari Libur: 09:00 - 22:00</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-maroon-800 text-center">
                <p class="text-sm text-maroon-300">
                    &copy; {{ date('Y') }} Dimsum BOS. Semua hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
