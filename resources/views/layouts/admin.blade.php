<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DXP Admin Portal</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-white flex-shrink-0 md:fixed md:h-full z-40 transition-transform duration-300"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

            <div class="h-16 flex items-center px-6 border-b border-slate-700">
                <div class="font-bold text-xl tracking-wider text-indigo-400">DXP<span class="text-white">Admin</span></div>
                <button @click="sidebarOpen = false" class="md:hidden ml-auto text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 shadow-md text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users') ? 'bg-indigo-600 shadow-md text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users
                </a>
                <a href="{{ route('admin.actions') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.actions') ? 'bg-indigo-600 shadow-md text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Actions
                </a>
                <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.analytics') ? 'bg-indigo-600 shadow-md text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-slate-800">
                <a href="/" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-white text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Exit to Site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 p-6 md:p-10 transition-all duration-300">
            <!-- Mobile Header -->
            <div class="md:hidden flex items-center justify-between mb-6">
                <div class="font-bold text-xl text-indigo-600">DXP Admin</div>
                <button @click="sidebarOpen = true" class="text-slate-600 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
