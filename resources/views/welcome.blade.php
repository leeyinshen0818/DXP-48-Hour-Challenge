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
<body class="antialiased text-slate-800 flex flex-col min-h-screen overflow-x-hidden">

    <!-- Navigation -->
    <nav class="w-full p-6 flex justify-between items-center z-50 relative shrink-0">
        <div class="text-2xl font-bold tracking-tighter text-indigo-600">DXP Academy</div>
        <div class="hidden md:flex space-x-6 text-sm font-semibold text-slate-500">
            <a href="#" class="hover:text-indigo-600">Programmes</a>
            <a href="#" class="hover:text-indigo-600">Mentors</a>
            <a href="#" class="hover:text-indigo-600">Login</a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="relative flex-1 flex flex-col justify-center items-center w-full min-h-[90vh] pb-32 lg:pb-0">

        <!-- Abstract Background Shapes & Mesh -->
        <div class="absolute inset-x-0 top-0 h-full overflow-hidden z-0">
             <div class="absolute top-[-20%] right-[-10%] w-[800px] h-[800px] bg-purple-100 rounded-full mix-blend-multiply filter blur-[120px] opacity-40 animate-blob"></div>
             <div class="absolute top-[20%] left-[-20%] w-[600px] h-[600px] bg-indigo-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob animation-delay-2000"></div>
             <div class="absolute bottom-[-10%] left-[20%] w-[600px] h-[600px] bg-pink-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob animation-delay-4000"></div>
             <!-- Grid Pattern Overlay -->
             <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        </div>

        <!-- Main Content Area -->
        <div class="relative z-10 w-full max-w-7xl px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- Left Column: The Hook (Marketing Copy) -->
            <div class="text-left space-y-8">

                 <!-- Badge -->
                <div class="inline-flex items-center space-x-2 px-4 py-2 bg-white/60 backdrop-blur-md border border-white/50 rounded-full shadow-sm hover:shadow-md transition-all cursor-default">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-indigo-600 text-xs font-bold tracking-widest uppercase">Re-imagine your career</span>
                </div>

                <!-- Headline -->
                <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] text-slate-900 tracking-tight">
                    Stop Browsing. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 animate-gradient-x">
                        Start Becoming.
                    </span>
                </h1>

                <!-- Subtext -->
                <p class="text-xl text-slate-600 max-w-lg leading-relaxed font-light">
                    Most career sites just give you a list of links. We give you a <strong class="text-slate-800 font-semibold">roadmap</strong> tailored to exactly where you are right now.
                </p>

                <!-- Social Proof User Base -->
                <div class="flex items-center space-x-4 pt-2">
                    <div class="flex -space-x-3">
                        <img class="w-12 h-12 rounded-full border-4 border-white shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff&font-size=0.5" alt="Alex">
                        <img class="w-12 h-12 rounded-full border-4 border-white shadow-sm" src="https://ui-avatars.com/api/?name=Sarah&background=random&color=fff&font-size=0.5" alt="User">
                        <img class="w-12 h-12 rounded-full border-4 border-white shadow-sm" src="https://ui-avatars.com/api/?name=John&background=random&color=fff&font-size=0.5" alt="User">
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 shadow-sm">+2k</div>
                    </div>
                    <div>
                        <p class="text-base font-bold text-slate-900">1,200+ leaders</p>
                        <p class="text-xs text-slate-500 font-medium">Joined in the last 24h</p>
                    </div>
                </div>

                <!-- Trusted By Signals -->
                <div class="pt-8 border-t border-slate-200/60">
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-4">Trusted by hiring managers at</p>
                    <div class="flex flex-wrap items-center gap-8 opacity-60 grayscale transition-all duration-500 hover:grayscale-0 hover:opacity-100">
                        <!-- Microsoft -->
                        <div class="group flex items-center gap-2 cursor-default">
                             <svg class="w-6 h-6 text-slate-500 group-hover:text-[#00a4ef] transition-colors" viewBox="0 0 24 24" fill="currentColor"><path d="M11.5 5.5A3.5 3.5 0 0 0 8 9v5h7V9a3.5 3.5 0 0 0-3.5-3.5m-5 .5v3h-2v5H2V6h2.5M19 6V9h2v5h2.5V6H19z"/></svg>
                             <span class="font-bold text-slate-500 group-hover:text-slate-800 text-lg transition-colors">Microsoft</span>
                        </div>
                         <!-- LinkedIn -->
                        <div class="group flex items-center gap-2 cursor-default">
                             <svg class="w-6 h-6 text-slate-500 group-hover:text-[#0a66c2] transition-colors" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm-1-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm5 7h-2v-3c0-.55-.45-1-1-1s-1 .45-1 1v3h-2v-6h2v1.1c.36-.55.97-.9 1.66-.9 1.25 0 2.15 1.05 2.15 2.1V17z"/></svg>
                             <span class="font-bold text-slate-500 group-hover:text-slate-800 text-lg transition-colors">LinkedIn</span>
                        </div>
                        <!-- Google -->
                         <div class="group flex items-center gap-2 cursor-default">
                             <svg class="w-6 h-6 text-slate-500 group-hover:text-[#EA4335] transition-colors" viewBox="0 0 24 24" fill="currentColor"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .587 5.387.587 12s5.28 12 11.893 12c3.48 0 6.147-1.133 8.213-3.293 2.12-2.12 2.76-5.267 2.627-7.947H12.48z"/></svg>
                             <span class="font-bold text-slate-500 group-hover:text-slate-800 text-lg transition-colors">Google</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Right Column: The Alexa Interface (Livewire Component) -->
            <div class="w-full flex justify-center lg:justify-end">
                <!-- Enclosing chatbox in a specific container as requested -->
                <div class="glass-panel p-2 rounded-2xl shadow-2xl overflow-hidden w-full max-w-2xl">
                     @livewire('alex-chat-interface')
                </div>
            </div>
        </div>

    </div>

    <!-- SECTION 2: THE "WHY" (Visual First) -->
    <section class="w-full bg-white py-24 relative z-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 mb-4 tracking-tight">
                    Less Reading. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">More Building.</span>
                </h2>
                <p class="text-xl text-slate-500 font-medium">We skip the fluff.</p>
            </div>

            <!-- Visual Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1 -->
                <div class="relative group h-80 rounded-[2.5rem] bg-indigo-50 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-200 hover:-translate-y-2">
                    <div class="absolute -right-10 -top-10 text-[15rem] leading-none opacity-10 select-none group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700">🎯</div>
                    <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-indigo-900/10 to-transparent">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-lg mb-6">🎯</div>
                        <h3 class="text-3xl font-black text-slate-900 mb-2">Precision.</h3>
                        <p class="text-slate-600 font-medium">Your career, reverse-engineered by AI.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="relative group h-80 rounded-[2.5rem] bg-purple-50 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-purple-200 hover:-translate-y-2">
                     <div class="absolute -right-10 -top-10 text-[15rem] leading-none opacity-10 select-none group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-700">⚡</div>
                    <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-purple-900/10 to-transparent">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-lg mb-6">⚡</div>
                        <h3 class="text-3xl font-black text-slate-900 mb-2">Expert.</h3>
                        <p class="text-slate-600 font-medium">Direct access to FAANG engineers.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="relative group h-80 rounded-[2.5rem] bg-pink-50 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-pink-200 hover:-translate-y-2">
                     <div class="absolute -right-10 -top-10 text-[15rem] leading-none opacity-10 select-none group-hover:scale-110 group-hover:rotate-6 transition-transform duration-700">🚀</div>
                    <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-pink-900/10 to-transparent">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-lg mb-6">🚀</div>
                        <h3 class="text-3xl font-black text-slate-900 mb-2">Launch.</h3>
                        <p class="text-slate-600 font-medium">Build a portfolio that gets you hired.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 3: SOCIAL PROOF / CTA -->
    <section class="w-full bg-slate-900 py-20 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
            <div class="absolute top-[-50%] left-[-10%] w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-50%] right-[-10%] w-[500px] h-[500px] bg-purple-600 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Ready to define your own path?</h2>
            <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                 <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="px-8 py-4 bg-white text-indigo-900 rounded-xl font-bold hover:bg-indigo-50 transition-colors shadow-lg hover:shadow-white/20 transform hover:-translate-y-1">
                    Talk to Alex Now
                </button>
                 <a href="#" class="px-8 py-4 bg-transparent border border-white/20 text-white rounded-xl font-medium hover:bg-white/10 transition-colors">
                    View Course Catalog
                </a>
            </div>
            <p class="mt-8 text-slate-400 text-sm">Join 1,200+ students already hired at top tech firms.</p>
        </div>
    </section>

    <!-- Simple Footer -->
    <footer class="bg-slate-950 text-slate-500 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <div class="mb-4 md:mb-0">
                &copy; {{ date('Y') }} DXP Academy. All rights reserved.
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
