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
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Enroll Now
                        </button>
                        <button @click="modalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
    </div>

        </div>
    </div>


    <script>
        function dashboardData() {
            return {
                activeTab: 'program',
                modalOpen: false,
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
                insightResources: [
                    {
                        title: 'Future of Work Report 2024',
                        type: 'PDF Report',
                        category: 'market_data',
                        readTime: '15 min read',
                        iconClass: 'bg-orange-50 text-orange-600',
                        downloadUrl: '#download-report-2024'
                    },
                    {
                        title: 'Tech Salary Trends Q3',
                        type: 'Market Data',
                        category: 'market_data',
                        readTime: '5 min read',
                        iconClass: 'bg-emerald-50 text-emerald-600',
                        downloadUrl: '#download-salary-trends'
                    },
                    {
                        title: 'Case Study: AI in FinTech',
                        type: 'Case Study',
                        category: 'case_studies',
                        readTime: '20 min read',
                        iconClass: 'bg-blue-50 text-blue-600',
                        downloadUrl: '#read-case-study'
                    },
                    {
                        title: 'Leadership in Remote Teams',
                        type: 'Article',
                        category: 'latest',
                        readTime: '8 min read',
                        iconClass: 'bg-purple-50 text-purple-600',
                        downloadUrl: 'https://hbr.org/'
                    },
                    {
                        title: 'Global Skills Index 2025',
                        type: 'PDF Report',
                        category: 'market_data',
                        readTime: '45 min read',
                        iconClass: 'bg-orange-50 text-orange-600',
                        downloadUrl: '#download-gsi-2025'
                    },
                    {
                        title: 'Startup Growth Metrics',
                        type: 'Cheatsheet',
                        category: 'latest',
                        readTime: '2 min read',
                        iconClass: 'bg-pink-50 text-pink-600',
                        downloadUrl: '#download-cheatsheet'
                    },
                    {
                        title: 'Design Systems Handbook',
                        type: 'eBook',
                        category: 'latest',
                        readTime: '3 hrs read',
                        iconClass: 'bg-indigo-50 text-indigo-600',
                        downloadUrl: '#download-handbook'
                    },
                    {
                        title: 'AWS Architecture Whitepaper',
                        type: 'Whitepaper',
                        category: 'case_studies',
                        readTime: '60 min read',
                        iconClass: 'bg-slate-100 text-slate-600',
                        downloadUrl: '#download-whitepaper'
                    },
                    {
                        title: 'Product Roadmap Template',
                        type: 'Template',
                        category: 'latest',
                        readTime: 'For Notion/Excel',
                        iconClass: 'bg-green-50 text-green-600',
                        downloadUrl: '#download-template'
                    },
                    {
                        title: 'Cybersecurity Threat Landscape',
                        type: 'Briefing',
                        category: 'market_data',
                        readTime: '10 min read',
                        iconClass: 'bg-red-50 text-red-600',
                        downloadUrl: '#download-briefing'
                    }
                ],
                libraryPrograms: [
                    {
                        title: 'Advanced Data Analytics',
                        description: 'Master Python & SQL for big data.',
                        duration: '8 Weeks',
                        level: 'intermediate',
                        icon: 'M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'
                    },
                    {
                        title: 'UX Design Fundamentals',
                        description: 'Build user-centric products.',
                        duration: '6 Weeks',
                        level: 'beginner',
                        icon: 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                    },
                    {
                        title: 'Cloud Computing (AWS)',
                        description: 'Deploy scalable applications.',
                        duration: '10 Weeks',
                        level: 'certification',
                        icon: 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z'
                    },
                    {
                        title: 'Agile Project Management',
                        description: 'Lead high-performance teams.',
                        duration: '4 Weeks',
                        level: 'intermediate',
                        icon: 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z'
                    },
                    {
                        title: 'AI Product Management',
                        description: 'Launch AI-driven products.',
                        duration: '8 Weeks',
                        level: 'intermediate',
                        icon: 'M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.131A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.858.575-4.181m13.256 11.332a.999.999 0 01-1.405-.296l-.924-1.455a.999.999 0 01.378-1.376c.456-.252.887-.551 1.285-.892a.999.999 0 00.203-1.39l-.924-1.455a.999.999 0 01-.442 1.442l-1.649.607a.999.999 0 01-1.31-.549l-.607-1.649a.999.999 0 01.137-1.016l1.455-.924z'
                    },
                    {
                        title: 'Cybersecurity Basics',
                        description: 'Protect enterprise assets.',
                        duration: '6 Weeks',
                        level: 'beginner',
                        icon: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'
                    },
                    {
                        title: 'Digital Marketing Mastery',
                        description: 'SEO, SEM & Social Strategy.',
                        duration: '12 Weeks',
                        level: 'beginner',
                        icon: 'M13 10V3L4 14h7v7l9-11h-7z'
                    },
                    {
                        title: 'Full Stack Development',
                        description: 'React, Node.js & Databases.',
                        duration: '24 Weeks',
                        level: 'certification',
                        icon: 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'
                    },
                    {
                        title: 'Financial Modeling',
                        description: 'Advanced Excel & Valuation.',
                        duration: '5 Weeks',
                        level: 'intermediate',
                        icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                    }
                ]
            }
        }
    </script>
</body>
</html>
