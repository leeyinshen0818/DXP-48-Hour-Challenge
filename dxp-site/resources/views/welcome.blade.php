<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DXP Challenge - Your Future Starts Here</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Custom minimalist vibe */
        body { font-family: 'Figtree', sans-serif; background-color: #f8fafc; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
    @livewireStyles
</head>
<body class="antialiased text-slate-800">

    <!-- Navigation Placeholder -->
    <nav class="absolute top-0 w-full p-6 flex justify-between items-center z-10">
        <div class="text-2xl font-bold tracking-tighter text-indigo-600">DXP Academy</div>
        <div class="hidden md:flex space-x-6 text-sm font-semibold text-slate-500">
            <a href="#" class="hover:text-indigo-600">Programmes</a>
            <a href="#" class="hover:text-indigo-600">Mentors</a>
            <a href="#" class="hover:text-indigo-600">Login</a>
        </div>
    </nav>

    <div class="relative min-h-screen flex flex-col justify-center items-center overflow-hidden">

        <!-- Abstract Background Shapes -->
        <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-[-10%] left-[-5%] w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <!-- Main Content Area -->
        <div class="relative z-10 w-full max-w-7xl px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Column: The Hook (Marketing Copy) -->
            <div class="text-left space-y-6">
                <div class="inline-block px-4 py-1 bg-indigo-50 rounded-full text-indigo-600 text-xs font-bold tracking-wide uppercase">
                    Re-imagine your career
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight text-slate-900">
                    Stop Browsing. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        Start Becoming.
                    </span>
                </h1>
                <p class="text-lg text-slate-600 max-w-lg leading-relaxed">
                    Most career sites just give you a list of links. We give you a roadmap tailored to exactly where you are right now.
                </p>

                <div class="flex items-center space-x-4 pt-4">
                    <div class="flex -space-x-2">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Sarah&background=random" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=John&background=random" alt="User">
                    </div>
                    <p class="text-sm font-medium text-slate-500">Join 1,200+ future leaders</p>
                </div>
            </div>


            <!-- Right Column: The "Alex" Interface (Livewire Component) -->
            <div class="w-full">
                @livewire('alex-chat-interface')
            </div>
        </div>

        <!-- Footer Trust Signals -->
        <div class="absolute bottom-6 w-full text-center">
            <p class="text-xs text-slate-400 uppercase tracking-widest">Trust partners</p>
            <div class="flex justify-center space-x-8 mt-2 opacity-50 grayscale">
                <!-- Just placeholder text for logos -->
                <span class="font-bold text-slate-300">MICROSOFT</span>
                <span class="font-bold text-slate-300">GOOGLE</span>
                <span class="font-bold text-slate-300">AMAZON</span>
            </div>
        </div>

    </div>

    @livewireScripts
</body>
</html>