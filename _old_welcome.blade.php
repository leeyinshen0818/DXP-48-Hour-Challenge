<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DXP Challenge - Your Future Starts Here</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
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

    <!-- Modern Header -->
    <header x-data="{ mobileMenuOpen: false }" class="fixed w-full top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo area -->
            <a href="/" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200 group-hover:rotate-6 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275Z"/></svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-800 group-hover:text-indigo-700 transition-colors">
                    DXP<span class="text-indigo-600">.Academy</span>
                </span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center space-x-1">
                <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">Programmes</a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">Mentors</a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">Success Stories</a>
            </nav>

            <!-- CTA Actions -->
            <div class="hidden md:flex items-center space-x-3">
                <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 px-3 py-2 transition-colors">Log in</a>
                <a href="#" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-full shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5 flex items-center gap-2">
                    Get Started
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                <svg x-show="mobileMenuOpen" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 18 12"/></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" style="display: none;"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-slate-100 shadow-xl p-4 flex flex-col space-y-4">
            <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg">Programmes</a>
            <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg">Mentors</a>
            <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg">Success Stories</a>
            <hr class="border-slate-100">
            <a href="#" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg">Log in</a>
            <a href="#" class="px-4 py-2 text-sm font-medium bg-slate-900 text-white rounded-lg text-center">Get Started</a>
        </div>
    </header>

    <!-- Main Container -->
    <div class="relative flex-1 flex flex-col justify-center items-center w-full min-h-[90vh] pb-32 lg:pb-0 pt-24">

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
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to define your own path?</h2>
            <p class="text-slate-400 mb-10 max-w-xl mx-auto">Join 1,200+ students already hired at top tech firms. Start building your future today.</p>

            <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl p-8 max-w-2xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div class="text-left space-y-4">
                        <h3 class="text-xl font-bold text-white">Get the full catalog</h3>
                        <p class="text-sm text-slate-400">Receive a detailed breakdown of all career paths, outcomes, and salary expectations.</p>

                        <!-- Simple Lead Capture Form -->
                        <form action="#" method="POST" class="space-y-3" onsubmit="event.preventDefault(); alert('Thanks! The syllabus is on its way.');">
                            <input type="email" placeholder="Enter your work email" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white/20 transition-all">
                            <button type="submit" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-lg font-bold text-sm hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-900/50">
                                Download Syllabus &rarr;
                            </button>
                        </form>
                    </div>

                    <div class="relative">
                         <div class="absolute inset-0 bg-indigo-500/20 blur-2xl rounded-full"></div>
                         <div class="relative bg-slate-900 border border-slate-700 rounded-xl p-6 text-center">
                            <div class="w-12 h-12 bg-indigo-500/20 rounded-full flex items-center justify-center mx-auto mb-3 text-indigo-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                            <h4 class="font-bold text-white mb-2">Unsure where to start?</h4>
                            <p class="text-xs text-slate-400 mb-4">Chat with Alex, our AI Career Architect, to find your perfect fit in 2 minutes.</p>
                             <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-full px-4 py-2 bg-white text-slate-900 rounded-lg font-bold text-sm hover:bg-slate-50 transition-colors">
                                Start AI Assessment
                            </button>
                         </div>
                    </div>
                </div>
            </div>
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
