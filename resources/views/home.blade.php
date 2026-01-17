<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Personal Dashboard - DXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Top Navigation -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                        DXP Academy
                    </span>
                    <span class="ml-4 px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-500 font-medium">
                        CareerOS v1.0
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-slate-600">Me: {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-sm text-red-500 hover:text-red-700">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MORPHING HERO SECTION -->
    <!-- The background color changes subtly based on interest -->
    <div class="relative overflow-hidden
        @if($user->career_interest == 'data') bg-blue-900
        @elseif($user->career_interest == 'management') bg-slate-900
        @elseif($user->career_interest == 'marketing') bg-purple-900
        @else bg-indigo-900 @endif
        text-white py-20">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:w-2/3">
                <div class="inline-flex items-center space-x-2 text-indigo-200 mb-4 bg-white/10 px-4 py-1.5 rounded-full backdrop-blur-sm border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    <span class="text-sm font-medium">Personalized for you</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                    {{ $heroHeadline }}
                </h1>
                <p class="text-xl text-white/80 max-w-2xl leading-relaxed">
                    Based on our chat, we've stripped away the noise. Here are the tools, insights, and connections you need to get unstuck and start leading in <strong>{{ ucfirst($user->career_interest) }}</strong>.
                </p>
            </div>
        </div>

        <!-- Abstract Background Decoration -->
        <div class="absolute right-0 top-0 h-full w-1/3 opacity-20 bg-gradient-to-l from-white to-transparent mix-blend-overlay"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500 rounded-full blur-3xl opacity-30"></div>
    </div>

    <!-- MAIN TWO COLUMN LAYOUT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT COLUMN: Curated Programmes -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Section Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-800">Your Recommended Path</h2>
                    <span class="text-sm text-slate-500">Filtered from 45+ courses</span>
                </div>

                @forelse($programmes as $course)
                    <div class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-indigo-500 transition-all group flex flex-col md:flex-row gap-6">
                        <!-- Date Badge -->
                        <div class="flex-shrink-0 flex flex-col items-center justify-center w-20 h-20 bg-indigo-50 rounded-2xl text-indigo-700">
                            <span class="text-sm font-bold uppercase">{{ \Carbon\Carbon::parse($course->start_date)->format('M') }}</span>
                            <span class="text-2xl font-black">{{ \Carbon\Carbon::parse($course->start_date)->format('d') }}</span>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="px-2 py-0.5 rounded text-xs font-bold uppercase bg-slate-100 text-slate-600 tracking-wide">{{ $course->category_tag }}</span>
                                @if($user->lead_score > 70)
                                    <span class="px-2 py-0.5 rounded text-xs font-bold uppercase bg-green-100 text-green-700 tracking-wide animate-pulse">Priority Match</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $course->title }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                {{ $course->description }}
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-slate-400 font-medium">
                                <span>Starting: {{ \Carbon\Carbon::parse($course->start_date)->format('d M, Y') }}</span>
                                <span>${{ number_format($course->price) }}</span>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="flex flex-col justify-center">
                            <button class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                                Secure Spot
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-slate-300">
                        <p class="text-slate-500">No specific courses found for this track yet, but our mentors are ready to chat.</p>
                    </div>
                @endforelse

                <!-- Thought Leadership Feed (Simulation) -->
                <div class="pt-8">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">Must-Read for Future {{ ucfirst($user->career_interest) }} Leaders</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-white p-4 rounded-xl border border-slate-100 flex items-center hover:bg-slate-50 cursor-pointer">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">AI</div>
                            <div class="ml-4">
                                <h4 class="font-bold text-slate-800 text-sm">How AI is Reshaping {{ ucfirst($user->career_interest) }} Jobs</h4>
                                <p class="text-xs text-slate-500">3 min read • By Sarah Jenkins (CTO)</p>
                            </div>
                        </div>
                         <div class="bg-white p-4 rounded-xl border border-slate-100 flex items-center hover:bg-slate-50 cursor-pointer">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold">TR</div>
                            <div class="ml-4">
                                <h4 class="font-bold text-slate-800 text-sm">Top 5 Trends in {{ ucfirst($user->career_interest) }} for 2026</h4>
                                <p class="text-xs text-slate-500">5 min read • Industry Report</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Insights & Stats -->
            <div class="space-y-6">
                <!-- Vibe Score Card -->
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border-t-4 border-indigo-500">
                    <h3 class="font-bold text-slate-400 text-xs uppercase tracking-widest mb-1">Your Urgency Score</h3>
                    <div class="flex items-end">
                        <span class="text-5xl font-black text-slate-900">{{ $user->lead_score }}</span>
                        <span class="text-lg font-bold text-slate-400 mb-1 ml-1">/ 100</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">
                        Based on your "stuck" feeling, we've prioritized your profile for our senior mentors.
                    </p>
                    <button class="mt-4 w-full py-2 bg-indigo-50 text-indigo-700 font-bold text-sm rounded-lg">
                        Talk to a Mentor Now
                    </button>
                </div>

                <!-- Market Data -->
                <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-xl">
                    <h3 class="font-bold text-slate-400 text-xs uppercase tracking-widest mb-4">Market Intelligence</h3>

                    <div class="space-y-6">
                        <div>
                            <div class="text-3xl font-bold">{{ $insights['salary'] }}</div>
                            <div class="text-sm text-slate-400">Average Salary</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-green-400">{{ $insights['growth'] }}</div>
                            <div class="text-sm text-slate-400">Projected Growth</div>
                        </div>
                         <div>
                             <p class="text-sm italic text-slate-300 border-l-2 border-indigo-500 pl-3">
                                "{{ $insights['tip'] }}"
                             </p>
                        </div>
                    </div>
                </div>

                <!-- Downloadable -->
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white">
                    <h3 class="font-bold text-lg mb-2">Free {{ ucfirst($user->career_interest) }} Career Guide</h3>
                    <p class="text-xs text-indigo-100 mb-4">Get the full PDF breakdown of skills you need.</p>
                    <button class="w-full bg-white text-indigo-600 font-bold py-2 rounded-lg text-sm">Download PDF</button>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
