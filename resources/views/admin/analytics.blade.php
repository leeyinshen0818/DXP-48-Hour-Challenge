@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Platform Analytics</h1>
            <p class="text-slate-500 mt-1">Deep dive into user behavior and platform performance.</p>
        </div>
        <div class="flex gap-2">
            <select class="px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white shadow-sm hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>This Quarter</option>
                <option>Year to Date</option>
            </select>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Report
            </button>
        </div>
    </div>

    <!-- KPI Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- KPI 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Total Views</h3>
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-bold text-slate-800">124.5K</span>
                <span class="text-xs font-semibold text-emerald-600 flex items-center">
                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +12.5%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">vs. previous 30 days</p>
        </div>

        <!-- KPI 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Avg. Session</h3>
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-bold text-slate-800">14m 22s</span>
                <span class="text-xs font-semibold text-blue-600 flex items-center">
                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +2.1%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">vs. previous 30 days</p>
        </div>

        <!-- KPI 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Bounce Rate</h3>
                <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-bold text-slate-800">42.3%</span>
                <span class="text-xs font-semibold text-emerald-600 flex items-center">
                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    -1.2%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">vs. previous 30 days</p>
        </div>

        <!-- KPI 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Conversion</h3>
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-bold text-slate-800">3.2%</span>
                <span class="text-xs font-semibold text-emerald-600 flex items-center">
                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +0.4%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">vs. previous 30 days</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Main Line Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lg:col-span-2">
            <h3 class="font-bold text-lg text-slate-800 mb-6">User Engagement & Retention</h3>
            <div class="relative h-72">
                <canvas id="engagementChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lg:col-span-1">
            <h3 class="font-bold text-lg text-slate-800 mb-6">Popular Programs</h3>
            <div class="relative h-64 flex justify-center">
                <canvas id="popularityChart"></canvas>
            </div>
            <div class="mt-6 space-y-3">
                <!-- Custom Legend Items (Static for now matching chart colors) -->
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                        <span class="text-slate-600">Cybersecurity</span>
                    </div>
                    <span class="font-semibold text-slate-800">300</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        <span class="text-slate-600">Software Eng.</span>
                    </div>
                    <span class="font-semibold text-slate-800">50</span>
                </div>
                <!-- ... others will be handled by chart JS but this is conceptual UI -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Engagement & Retention Chart
        const ctxEngagement = document.getElementById('engagementChart').getContext('2d');
        new Chart(ctxEngagement, {
            type: 'line',
            data: {
                labels: @json($analyticsData['labels']),
                datasets: [
                    {
                        label: 'Engagement Score',
                        data: @json($analyticsData['engagement']),
                        borderColor: '#4f46e5', // Indigo 600
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Retention Rate (%)',
                        data: @json($analyticsData['retention']),
                        borderColor: '#10b981', // Emerald 500
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        tension: 0.4,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            borderDash: [2, 4],
                            color: '#e2e8f0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Popularity Chart
        const ctxPopularity = document.getElementById('popularityChart').getContext('2d');
        new Chart(ctxPopularity, {
            type: 'doughnut',
            data: {
                labels: ['Cybersecurity', 'Data Science', 'Software Eng.', 'Cloud Computing'],
                datasets: [{
                    data: @json($analyticsData['program_popularity']),
                    backgroundColor: [
                        '#4f46e5', // Indigo
                        '#06b6d4', // Cyan
                        '#10b981', // Emerald
                        '#f59e0b', // Amber
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false // Using custom legend HTML above for better control or just simplicity here
                    }
                }
            }
        });
    </script>
@endsection
