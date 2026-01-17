@extends('layouts.program')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Available Programs</h1>
        <p class="mb-4">Explore our structured learning paths designed for your career growth.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="p-6 bg-white border border-slate-200 rounded-lg shadow-sm">
                <h2 class="text-xl font-bold text-indigo-600">Software Engineering Immersive</h2>
                <div class="flex items-center gap-2 mt-2 text-slate-500 text-sm">
                    <span>📅 Starts: Feb 15, 2026</span>
                    <span>•</span>
                    <span>🎯 Audience: Beginners</span>
                </div>
                <p class="mt-4 text-slate-600">Master full-stack development with hands-on projects and mentorship.</p>
                <div class="mt-6">
                    <h3 class="font-semibold text-slate-900 text-sm uppercase tracking-wide">Learning Outcomes</h3>
                    <ul class="list-disc list-inside mt-2 text-slate-500 text-sm space-y-1">
                        <li>Proficiency in React & Laravel</li>
                        <li>Database Design & API Development</li>
                        <li>Agile Workflow mastery</li>
                    </ul>
                </div>
                <div class="mt-8">
                     <a href="/programs/software-engineering" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700">View Program</a>
                </div>
            </div>

            <!-- Example Card 2 -->
             <div class="p-6 bg-white border border-slate-200 rounded-lg shadow-sm">
                <h2 class="text-xl font-bold text-purple-600">AI & Data Science Track</h2>
                <div class="flex items-center gap-2 mt-2 text-slate-500 text-sm">
                    <span>📅 Starts: Mar 10, 2026</span>
                     <span>•</span>
                    <span>🎯 Audience: Intermediate</span>
                </div>
                <p class="mt-4 text-slate-600">Deep dive into machine learning models, python data analysis, and AI ethics.</p>
                 <div class="mt-6">
                     <h3 class="font-semibold text-slate-900 text-sm uppercase tracking-wide">Learning Outcomes</h3>
                     <ul class="list-disc list-inside mt-2 text-slate-500 text-sm space-y-1">
                        <li>Python for Data Science</li>
                        <li>Neural Networks Basics</li>
                        <li>Building RAG Applications</li>
                    </ul>
                </div>
                <div class="mt-8">
                     <a href="#" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-md font-semibold hover:bg-purple-700">View Program</a>
                </div>
            </div>
        </div>
    </div>
@endsection
