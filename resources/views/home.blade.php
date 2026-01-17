<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-y-scroll">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Personal Dashboard - DXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Top Navigation -->
    <nav class="bg-white/90 backdrop-blur-sm border-b border-slate-200 sticky top-0 z-50 supports-[backdrop-filter]:bg-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-slate-900 leading-none">DXP Academy</span>
                        <span class="text-[10px] font-semibold tracking-wider text-indigo-500 uppercase mt-0.5">CareerOS v1.0</span>
                    </div>
                </div>

                <!-- User & Actions -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                        <div class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- Profile -->
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-900 leading-none group-hover:text-indigo-600 transition-colors">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 font-medium uppercase mt-1">{{ ucfirst($user->career_interest) ?? 'Student' }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center text-sm font-bold shadow-md shadow-indigo-200">
                             {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <!-- Logout -->
                    <a href="{{ route('logout') }}" class="ml-2 text-slate-300 hover:text-red-500 transition-colors" title="Logout">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- COMPACT HERO SECTION -->
    <div class="relative bg-slate-900 border-b border-white/10 overflow-hidden">
        <div class="absolute right-0 top-0 h-full w-1/3 opacity-30 bg-gradient-to-l from-indigo-900 via-slate-900 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-10">
            <div class="flex items-center gap-4 mb-2">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <span class="text-xs font-bold tracking-widest uppercase text-indigo-400">Verified Roadmap</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2 leading-tight">
                {{ $heroHeadline }}
            </h1>
            <p class="text-sm text-slate-400 max-w-2xl">
               Your personalized executive summary to break into <strong class="text-indigo-200">{{ ucfirst($user->career_interest) }}</strong>.
            </p>
        </div>
    </div>

    <!-- MAIN APP CONTAINER (Alpine.js State) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-20" x-data="dashboardData()">

        <!-- PROGRAM DETAILS MODAL -->
        <div x-show="modalOpen"
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto"
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="modalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    <div class="bg-indigo-600 px-4 py-6 sm:px-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl leading-6 font-bold text-white" id="modal-title" x-text="selectedCourse.title"></h3>
                            <button @click="modalOpen = false" class="text-indigo-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500 mb-6 leading-relaxed" x-text="selectedCourse.description"></p>

                                    <!-- Learning Outcomes -->
                                    <div class="mb-6">
                                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wide mb-3">What You'll Learn</h4>
                                        <ul class="space-y-2">
                                            <template x-for="outcome in selectedCourse.outcomes" :key="outcome">
                                                <li class="flex items-start text-sm text-slate-600">
                                                    <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                    <span x-text="outcome"></span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>

                                    <!-- Target Audience -->
                                    <div class="mb-6">
                                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wide mb-2">Who this is for</h4>
                                        <p class="text-sm text-slate-600" x-text="selectedCourse.audience"></p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg border border-slate-100">
                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tuition</span>
                                            <span class="block text-lg font-black text-slate-900" x-text="'$' + new Intl.NumberFormat().format(selectedCourse.price)"></span>
                                        </div>
                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Next Cohort</span>
                                            <span class="block text-lg font-black text-slate-900" x-text="selectedCourse.startDate ? new Date(selectedCourse.startDate).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'TBA'"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button @click="if(isGuest) { modalOpen = false; registrationModalOpen = true; } else { window.location.href='/programs/software-engineering'; }" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:w-auto sm:text-sm">
                            Enroll Now
                        </button>
                        <a href="{{ route('programs.show') }}" class="w-full inline-flex justify-center rounded-md border border-indigo-200 shadow-sm px-4 py-2 bg-indigo-50 text-base font-medium text-indigo-700 hover:bg-indigo-100 focus:outline-none sm:w-auto sm:text-sm">
                            View Full Syllabus
                        </a>
                        <button @click="modalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- SIDEBAR NAVIGATION -->
            <aside class="w-full lg:w-64 flex-shrink-0 lg:sticky lg:top-24 z-30">
                <nav class="space-y-2">
                    <div class="px-4 py-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Menu</div>

                    <button @click="activeTab = 'program'"
                            :class="activeTab === 'program' ? 'bg-white text-indigo-700 shadow-md border-indigo-200' : 'text-slate-600 hover:bg-white hover:text-slate-900 border-transparent'"
                            class="w-full group flex items-center px-4 py-3 text-sm font-bold rounded-xl border transition-all text-left">
                        <span :class="activeTab === 'program' ? 'bg-indigo-600' : 'bg-slate-300 group-hover:bg-slate-400'" class="w-2 h-2 rounded-full mr-3 transition-colors"></span>
                        Core Path
                    </button>

                    <button @click="activeTab = 'insights'"
                             :class="activeTab === 'insights' ? 'bg-white text-purple-700 shadow-md border-purple-200' : 'text-slate-600 hover:bg-white hover:text-slate-900 border-transparent'"
                             class="w-full group flex items-center px-4 py-3 text-sm font-bold rounded-xl border transition-all text-left">
                        <span :class="activeTab === 'insights' ? 'bg-purple-600' : 'bg-slate-300 group-hover:bg-slate-400'" class="w-2 h-2 rounded-full mr-3 transition-colors"></span>
                        Strategic Insights
                    </button>

                    <button @click="activeTab = 'velocity'"
                            :class="activeTab === 'velocity' ? 'bg-white text-emerald-700 shadow-md border-emerald-200' : 'text-slate-600 hover:bg-white hover:text-slate-900 border-transparent'"
                            class="w-full group flex items-center px-4 py-3 text-sm font-bold rounded-xl border transition-all text-left">
                        <span :class="activeTab === 'velocity' ? 'bg-emerald-600' : 'bg-slate-300 group-hover:bg-slate-400'" class="w-2 h-2 rounded-full mr-3 transition-colors"></span>
                        Trending Now
                    </button>
                </nav>

                <div class="mt-8 p-5 bg-gradient-to-br from-slate-900 to-indigo-900 rounded-xl text-white shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full blur-2xl -mr-12 -mt-12"></div>
                    <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest mb-2">My Session</p>
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                        <span class="text-sm font-bold">Online Now</span>
                    </div>
                </div>
            </aside>

            <!-- CONTENT AREA -->
            <div class="flex-1 min-w-0">

                <!-- VIEW 1: RECOMMENDED PROGRAM -->
                <div x-show="activeTab === 'program'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-8">

                    <!-- Section Header -->
                    <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden flex justify-between items-center">
                         <div class="relative z-10">
                             <h2 class="text-xl font-bold mb-1">Your Personalized Roadmap</h2>
                             <p class="text-indigo-100 text-sm">Programs matched to your profile.</p>
                         </div>
                         <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent"></div>
                    </div>

                    <!-- Filter Bar -->
                    <div class="flex items-center gap-4 overflow-x-auto pb-2">
                        <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">All Programs</button>
                        <button @click="activeFilter = 'beginner'" :class="activeFilter === 'beginner' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Beginner</button>
                        <button @click="activeFilter = 'intermediate'" :class="activeFilter === 'intermediate' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Intermediate</button>
                        <button @click="activeFilter = 'certification'" :class="activeFilter === 'certification' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Certification</button>

                        <!-- NEW Secure Spot Button -->
                         <div class="ml-auto"> <!-- Push to the right -->
                            <button @click="if(isGuest) { registrationModalOpen = true; } else { window.location.href='/programs/software-engineering'; }"
                                    class="relative px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-xs font-bold rounded-full shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 transition-all transform hover:-translate-y-0.5 flex items-center gap-2 overflow-hidden group">
                                <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                                <span class="relative z-10">SECURE YOUR SPOT</span>
                                <svg class="w-4 h-4 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Core Recommendations -->
                    <div x-show="activeFilter === 'all'">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Priority Matches</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($programmes as $course)
                            <div @click="modalOpen = true; selectedCourse = {
                                title: '{{ addslashes($course->title) }}',
                                description: '{{ addslashes($course->description) }}',
                                price: {{ $course->price }},
                                startDate: '{{ $course->start_date }}',
                                audience: 'Ambitious professionals looking to break into {{ addslashes($user->career_interest) }}',
                                outcomes: ['Master core {{ addslashes($user->career_interest) }} competencies', 'Build a portfolio of real-world projects', '1-on-1 Mentorship from industry experts', 'Interview preparation and resume review']
                            }"
                                 class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover:border-indigo-300 transition-all cursor-pointer group flex flex-col h-full ring-1 ring-indigo-50">

                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex justify-between items-start mb-4">
                                         <div class="w-12 h-12 bg-indigo-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                                             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                         </div>
                                         <span class="bg-indigo-50 text-indigo-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide">98% Match</span>
                                    </div>

                                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $course->title }}</h3>
                                    <p class="text-sm text-slate-500 mb-4 line-clamp-3 leading-relaxed flex-1">{{ $course->description }}</p>

                                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] uppercase font-bold text-slate-400">Start</span>
                                            <span class="text-xs font-bold text-slate-900">{{ \Carbon\Carbon::parse($course->start_date)->format('M d') }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm font-bold text-indigo-600 group-hover:translate-x-1 inline-block transition-transform">View Details &rarr;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-2 p-12 text-center text-slate-500 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                No recommended programs found for this track yet.
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Library Section (Placeholder for "More") -->
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Explore Library</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <template x-for="program in libraryPrograms">
                                <div x-show="activeFilter === 'all' || program.level === activeFilter"
                                     @click="modalOpen = true; selectedCourse = {
                                        ...program,
                                        price: 1499,
                                        startDate: '2024-04-15',
                                        audience: 'Self-start learners looking to upskill at their own pace.',
                                        outcomes: ['Comprehensive access to course materials', 'Community support and networking', 'Certificate of Completion']
                                     }"
                                     class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-lg hover:border-indigo-200 transition-all cursor-pointer group">
                                    <div class="w-10 h-10 bg-indigo-50 rounded-lg border border-indigo-100 mb-3 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="program.icon" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 mb-1 group-hover:text-indigo-600" x-text="program.title"></h4>
                                    <p class="text-xs text-slate-500 mb-2 line-clamp-2" x-text="program.description"></p>
                                    <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded" x-text="program.duration"></span>
                                </div>
                            </template>

                            <!-- View All Card -->
                            <div x-show="activeFilter === 'all'" class="bg-indigo-50 rounded-2xl border border-indigo-100 p-5 hover:bg-indigo-100 hover:shadow-md transition-all cursor-pointer flex flex-col items-center justify-center text-center">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-indigo-600 mb-2 shadow-sm">
                                    <span class="font-bold text-lg">+12</span>
                                </div>
                                <h4 class="text-sm font-bold text-indigo-900">View Full Catalog</h4>
                                <p class="text-[10px] text-indigo-500">Explore all 20+ programs</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VIEW 2: STRATEGIC INSIGHTS -->
                <div x-show="activeTab === 'insights'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-8" style="display: none;">

                    <!-- Section Header -->
                    <div class="bg-purple-600 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden flex justify-between items-center">
                         <div class="relative z-10">
                             <h2 class="text-xl font-bold mb-1">Market Intelligence</h2>
                             <p class="text-purple-100 text-sm">Curated reading for your career path.</p>
                         </div>
                         <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent"></div>
                    </div>

                    <!-- Filter Bar -->
                    <div class="flex items-center gap-4 overflow-x-auto pb-2">
                        <button @click="activeInsightFilter = 'all'" :class="activeInsightFilter === 'all' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">All Insights</button>
                        <button @click="activeInsightFilter = 'market_data'" :class="activeInsightFilter === 'market_data' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Market Data</button>
                        <button @click="activeInsightFilter = 'case_studies'" :class="activeInsightFilter === 'case_studies' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Case Studies</button>
                        <button @click="activeInsightFilter = 'latest'" :class="activeInsightFilter === 'latest' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap transition-colors">Latest Trends</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <template x-for="resource in insightResources">
                            <div x-show="activeInsightFilter === 'all' || resource.category === activeInsightFilter || (activeInsightFilter === 'all' && resource.category === 'latest')"
                                 class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-xl hover:border-purple-300 transition-all group">
                                 <div>
                                     <div class="flex justify-between items-start mb-4">
                                         <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-[10px] uppercase tracking-wider"
                                              :class="resource.iconClass"
                                              x-text="resource.type.split(' ')[0]">
                                         </div>
                                         <span class="text-[10px] font-bold text-slate-400 uppercase" x-text="resource.readTime"></span>
                                     </div>
                                     <h4 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-purple-700 transition-colors" x-text="resource.title"></h4>
                                     <p class="text-sm text-slate-500 mb-4 leading-relaxed">Essential strategic reading for your career path.</p>
                                 </div>
                                 <a :href="resource.downloadUrl"
                                    @click.prevent="resource.downloadUrl.startsWith('#') ? alert('Downloading mock file: ' + resource.title + '...') : window.open(resource.downloadUrl, '_blank')"
                                    class="text-indigo-600 text-sm font-bold hover:underline inline-flex items-center group-hover:translate-x-1 transition-transform">
                                    <span x-text="resource.downloadUrl.startsWith('#') ? 'Download Resource' : 'View External Link'"></span>
                                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                 </a>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- VIEW 3: COMMUNITY TRENDS -->
                <div x-show="activeTab === 'velocity'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-8" style="display: none;">

                    <!-- Section Header -->
                    <div class="bg-emerald-600 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden flex justify-between items-center">
                         <div class="relative z-10">
                             <h2 class="text-xl font-bold mb-1">Community Trends</h2>
                             <p class="text-emerald-100 text-sm">See what thousands of other professionals are learning.</p>
                         </div>
                         <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ platformStats: { active: 12450, completions: 3200, hours: 85000 } }">
                        <!-- STAT: TARGET ROLE ANALYSIS -->
                        <div class="bg-slate-900 rounded-2xl shadow-lg border border-slate-800 overflow-hidden text-white relative group">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-500 rounded-full blur-[80px] opacity-20 -mr-10 -mt-10"></div>

                            <div class="p-8 relative z-10 flex flex-col h-full justify-between">
                                 <div>
                                     <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-indigo-500/30">
                                         <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span> Your Target Role
                                     </div>
                                     <h3 class="text-2xl font-bold mb-1">{{ ucfirst($user->career_interest) }}</h3>
                                     <p class="text-slate-400 text-sm">Market analysis for your selected path.</p>
                                 </div>

                                 <div class="mt-8">
                                     <div class="grid grid-cols-2 gap-4">
                                         <div>
                                             <div class="flex items-end gap-2 mb-1">
                                                 <span class="text-3xl font-black text-white">High</span>
                                             </div>
                                             <p class="text-xs text-slate-500 uppercase font-bold">Demand Level</p>
                                         </div>
                                         <div>
                                             <div class="flex items-end gap-2 mb-1">
                                                 <span class="text-3xl font-black text-emerald-400">+12%</span>
                                             </div>
                                             <p class="text-xs text-slate-500 uppercase font-bold">YoY Growth</p>
                                         </div>
                                     </div>
                                     <div class="mt-4 pt-4 border-t border-white/10">
                                         <p class="text-xs text-indigo-300 flex items-center gap-1">
                                             <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                             <span>Trending upward in Q4 2026</span>
                                         </p>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <!-- Platform Activity Widget -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                                <h2 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Platform Pulse</h2>
                            </div>
                             <div class="p-6 flex-1 flex flex-col justify-center gap-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                    <div>
                                        <span class="block text-2xl font-bold text-slate-900" x-text="new Intl.NumberFormat().format(platformStats.active)"></span>
                                        <span class="text-xs text-slate-500 font-bold uppercase">Active Learners</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <div>
                                        <span class="block text-2xl font-bold text-slate-900" x-text="new Intl.NumberFormat().format(platformStats.completions)"></span>
                                        <span class="text-xs text-slate-500 font-bold uppercase">Certifications Issued</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <div>
                                        <span class="block text-2xl font-bold text-slate-900" x-text="new Intl.NumberFormat().format(platformStats.hours) + '+'"></span>
                                        <span class="text-xs text-slate-500 font-bold uppercase">Learning Hours</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LEADERBOARD LIST -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex justify-between items-center">
                             <h2 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Top Enrolled Programs</h2>
                             <span class="text-[10px] uppercase font-bold text-slate-400">Live Rankings</span>
                        </div>
                        <div class="divide-y divide-slate-100">
                            <!-- Rank 1 -->
                            <div class="p-4 flex items-center hover:bg-slate-50 transition-colors">
                                <span class="text-lg font-black text-slate-300 w-8 text-center mr-4">1</span>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-900">Full Stack Development</h4>
                                    <p class="text-xs text-slate-500">Engineering</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-600">2,458</span>
                                    <span class="text-[10px] text-slate-400">Users</span>
                                </div>
                            </div>
                            <!-- Rank 2 -->
                            <div class="p-4 flex items-center hover:bg-slate-50 transition-colors">
                                <span class="text-lg font-black text-slate-300 w-8 text-center mr-4">2</span>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-900">AI Product Management</h4>
                                    <p class="text-xs text-slate-500">Product</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-600">1,892</span>
                                    <span class="text-[10px] text-slate-400">Users</span>
                                </div>
                            </div>
                            <!-- Rank 3 -->
                            <div class="p-4 flex items-center hover:bg-slate-50 transition-colors">
                                <span class="text-lg font-black text-slate-300 w-8 text-center mr-4">3</span>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-900">Advanced Data Analytics</h4>
                                    <p class="text-xs text-slate-500">Data Science</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-600">1,650</span>
                                    <span class="text-[10px] text-slate-400">Users</span>
                                </div>
                            </div>
                            <!-- Rank 4 -->
                            <div class="p-4 flex items-center hover:bg-slate-50 transition-colors">
                                <span class="text-lg font-black text-slate-300 w-8 text-center mr-4">4</span>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-900">Digital Marketing Mastery</h4>
                                    <p class="text-xs text-slate-500">Marketing</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-600">1,204</span>
                                    <span class="text-[10px] text-slate-400">Users</span>
                                </div>
                            </div>
                            <!-- Rank 5 -->
                            <div class="p-4 flex items-center hover:bg-slate-50 transition-colors">
                                <span class="text-lg font-black text-slate-300 w-8 text-center mr-4">5</span>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-900">UX Design Fundamentals</h4>
                                    <p class="text-xs text-slate-500">Design</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-600">980</span>
                                    <span class="text-[10px] text-slate-400">Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    <div x-show="registrationModalOpen"
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="registrationModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">

                <div class="bg-white px-8 pt-8 pb-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 mb-4">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Create Account</h3>
                    <p class="text-slate-500 text-sm mt-2">Join 10,000+ professionals boosting their careers.</p>
                </div>

                <div class="px-8 pb-8">
                    <!-- Social Login -->
                    <div class="space-y-3">
                        <button type="button" class="w-full flex items-center justify-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                            Continue with Google
                        </button>
                        <button type="button" class="w-full flex items-center justify-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">
                            <svg class="w-5 h-5 text-[#0077b5]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            Continue with LinkedIn
                        </button>
                    </div>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-400 font-medium">Or continue with email</span>
                        </div>
                    </div>

                    <form action="{{ route('register.complete') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all placeholder-slate-400">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Email Address</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all placeholder-slate-400">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Password</label>
                                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all placeholder-slate-400">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Confirm</label>
                                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all placeholder-slate-400">
                            </div>
                        </div>

                        <div class="pt-2">
                             <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                                Complete Registration
                            </button>
                        </div>

                        <div class="text-center mt-4">
                             <button type="button" @click="registrationModalOpen = false" class="text-slate-400 text-xs font-bold hover:text-slate-600 transition-colors">
                                I'll do this later
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>

    <script>
        function dashboardData() {
            return {
                isGuest: {{ Auth::user()->is_guest ? 'true' : 'false' }},
                activeTab: 'program',
                modalOpen: false,
                registrationModalOpen: false,
                selectedCourse: {
                    title: '',
                    description: '',
                    price: 0,
                    startDate: null, // Initialize as null
                    outcomes: [],
                    audience: ''
                },
                activeFilter: 'all',
                activeInsightFilter: 'all',
                insightResources: @json($dbInsights),
                libraryPrograms: @json($dbLibraryPrograms)
            }
        }
    </script>
</body>
</html>
