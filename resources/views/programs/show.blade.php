@extends('layouts.program')

@section('content')
    <div class="bg-indigo-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <span class="inline-block px-3 py-1 bg-indigo-500/30 text-indigo-200 rounded-full text-xs font-bold uppercase tracking-wide mb-4">Software Engineering Immersive</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Become a Full-Stack Developer</h1>
            <p class="text-xl text-indigo-200 max-w-2xl">A 12-week intensive program designed to take you from hello world to hired. Master the tools top tech companies use.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- Left: Details -->
        <div class="lg:col-span-2 space-y-12">

            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Target Audience</h2>
                <p class="text-slate-600 leading-relaxed">
                    This program is ideal for career switchers, recent graduates, or self-taught developers looking to structure their knowledge. No prior professional coding experience is required, but a passion for problem-solving is essential.
                </p>
            </section>

             <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Learning Outcomes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-slate-600">Build complex web applications with React & Laravel</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-slate-600">Design scalable database schemas</span>
                    </div>
                     <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-slate-600">Deploy applications to cloud infrastructure</span>
                    </div>
                     <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-slate-600">Collaborate using Git & Agile workflows</span>
                    </div>
                </div>
            </section>

            <section>
                 <h2 class="text-2xl font-bold text-slate-900 mb-4">Curriculum Overview</h2>
                 <div class="space-y-4">
                     <div class="border border-slate-200 rounded-lg p-4">
                         <div class="font-bold text-indigo-600 mb-1">Week 1-4</div>
                         <div class="font-semibold text-slate-900">Foundations</div>
                         <p class="text-sm text-slate-500 mt-1">HTML, CSS, JavaScript Deep Dive, Data Structures.</p>
                     </div>
                     <div class="border border-slate-200 rounded-lg p-4">
                         <div class="font-bold text-indigo-600 mb-1">Week 5-8</div>
                         <div class="font-semibold text-slate-900">Frontend Engineering</div>
                         <p class="text-sm text-slate-500 mt-1">React, State Management, API Integration.</p>
                     </div>
                      <div class="border border-slate-200 rounded-lg p-4">
                         <div class="font-bold text-indigo-600 mb-1">Week 9-12</div>
                         <div class="font-semibold text-slate-900">Backend & DevOps</div>
                         <p class="text-sm text-slate-500 mt-1">Laravel, SQL, Authentication, Deployment.</p>
                     </div>
                 </div>
            </section>
        </div>

        <!-- Right: Registration -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 sticky top-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Registration</h3>

                <div class="space-y-4 mb-6">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Start Date</span>
                        <span class="font-medium text-slate-900">Feb 15, 2026</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Duration</span>
                        <span class="font-medium text-slate-900">12 Weeks / Full-time</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Format</span>
                        <span class="font-medium text-slate-900">Online Live</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <button class="w-full py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                        Apply Now
                    </button>
                    <button class="w-full py-3 bg-white border border-indigo-200 text-indigo-700 font-bold rounded-lg hover:bg-indigo-50 transition-colors">
                        Download Syllabus
                    </button>
                </div>

                <p class="text-xs text-center text-slate-400 mt-4">Limited spots available for the Feb cohort.</p>
            </div>
        </div>

    </div>
@endsection
