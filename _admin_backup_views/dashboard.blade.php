@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Dashboard Overview</h1>
            <p class="text-slate-500 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200">Generate Report</button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Stat Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <div class="text-slate-500 text-sm font-medium uppercase tracking-wider">Total Users</div>
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</div>
            <div class="text-green-500 text-xs font-semibold mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                +12% from last week
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <div class="text-slate-500 text-sm font-medium uppercase tracking-wider">Active Now</div>
                <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $stats['active_now'] }}</div>
                <div class="text-slate-400 text-xs font-semibold mt-2">
                Online users
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <div class="text-slate-500 text-sm font-medium uppercase tracking-wider">Completion Rate</div>
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $stats['completion_rate'] }}</div>
                <div class="text-green-500 text-xs font-semibold mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                +4% increase
            </div>
        </div>

            <!-- Stat Card 4 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <div class="text-slate-500 text-sm font-medium uppercase tracking-wider">Total Revenue</div>
                <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $stats['revenue'] }}</div>
            <div class="text-slate-400 text-xs font-semibold mt-2">YTD</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Registration Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-lg text-slate-800 mb-4">User Registration Increment</h3>
            <div class="relative h-64 w-full">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        <!-- Active Users Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Active Users Trend</h3>
            <div class="relative h-64 w-full">
                <canvas id="activeUserChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-lg text-slate-800">Recent Registrations</h3>
            <a href="{{ route('admin.users') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-4 font-medium">User</th>
                        <th class="p-4 font-medium">Role</th>
                        <th class="p-4 font-medium">Alex Chat</th>
                        <th class="p-4 font-medium">Programs</th>
                        <th class="p-4 font-medium">Sections</th>
                        <th class="p-4 font-medium">Time Spent</th>
                        <th class="p-4 font-medium">Status</th>
                        <th class="p-4 font-medium">Joined</th>
                        <th class="p-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentUsers as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-xs">
                                    {{ substr($user['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800 text-sm">{{ $user['name'] }}</div>
                                    <div class="text-xs text-slate-500">{{ $user['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user['role'] === 'Mentor' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $user['role'] }}
                                </span>
                        </td>
                        <td class="p-4">
                            @if(isset($user['alex_completed']) && $user['alex_completed'])
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-md border border-green-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Done
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-md border border-amber-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-slate-600 font-medium">
                            {{ $user['programs_explored'] ?? 0 }}
                        </td>
                        <td class="p-4 text-sm text-slate-600 font-medium">
                            {{ $user['sections_explored'] ?? 0 }}
                        </td>
                        <td class="p-4 text-sm text-slate-500">
                            {{ $user['time_spent'] ?? '-' }}
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user['status'] === 'Active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                @if($user['status'] === 'Active')
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                @else
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                @endif
                                {{ $user['status'] }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-slate-500">{{ $user['joined'] }}</td>
                        <td class="p-4 text-right">
                            <button class="text-slate-400 hover:text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            // Registration Chart
            const ctxReg = document.getElementById('registrationChart').getContext('2d');
            new Chart(ctxReg, {
                type: 'line',
                data: {
                    labels: chartData.dates,
                    datasets: [{
                        label: 'New Registrations',
                        data: chartData.registrations,
                        borderColor: '#4f46e5', // Indigo 600
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [2, 4], color: '#f1f5f9' },
                            ticks: { font: { family: 'Figtree' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Figtree' } }
                        }
                    }
                }
            });

            // Active Users Chart
            const ctxActive = document.getElementById('activeUserChart').getContext('2d');
            new Chart(ctxActive, {
                type: 'bar',
                data: {
                    labels: chartData.dates,
                    datasets: [{
                        label: 'Active Users',
                        data: chartData.active_users,
                        backgroundColor: '#10b981', // Emerald 500
                        borderRadius: 4,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [2, 4], color: '#f1f5f9' },
                            ticks: { font: { family: 'Figtree' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Figtree' } }
                        }
                    }
                }
            });
        });
    </script>
@endsection
