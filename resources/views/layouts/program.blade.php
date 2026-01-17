<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DXP Academy - Programs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>body { font-family: 'Figtree', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-slate-800">
    <nav class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="/" class="text-xl font-bold tracking-tight text-indigo-600">DXP Academy</a>
            <div class="hidden md:flex space-x-6 text-sm font-semibold text-slate-500">
                <a href="/programs" class="text-indigo-600">Programs</a>
                <a href="#" class="hover:text-indigo-600">Mentors</a>
                <a href="/admin" class="hover:text-indigo-600">Admin Portal</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-white border-t border-slate-100 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-slate-400 text-sm">
            &copy; {{ date('Y') }} DXP Academy. All rights reserved.
        </div>
    </footer>
</body>
</html>
