@extends('layouts.admin')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">User Management</h1>
            <p class="text-slate-500 mt-1">Manage and view details of all registered users.</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Filter Component -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 bg-white">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filters
                </button>
                <div x-show="open"
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-100 py-1 z-20"
                     style="display: none;">
                    <div class="px-4 py-2 border-b border-slate-50">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</span>
                    </div>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span> Online Now
                    </a>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span> Active Account
                    </a>
                    <div class="px-4 py-2 border-t border-b border-slate-50 mt-1">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Role</span>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Professionals</a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Students</a>
                    <div class="px-4 py-2 border-t border-b border-slate-50 mt-1">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Career Interest</span>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Data Science</a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Design</a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Development</a>
                    <div class="px-4 py-2 border-t border-b border-slate-50 mt-1">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Others</span>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Joined This Week</a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Pending Verification</a>
                </div>
            </div>

            <div class="relative">
                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-64 shadow-sm">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-md">Add User</button>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-5 font-medium">User Details</th>
                        <th class="p-5 font-medium">Role</th>
                        <th class="p-5 font-medium">Career Interest</th>
                        <th class="p-5 font-medium">Status</th>
                        <th class="p-5 font-medium">Joined Date</th>
                        <th class="p-5 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="p-5">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm shadow-sm border border-indigo-200">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                    @if($loop->even)
                                        <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full shadow-sm" title="Online Now"></div>
                                    @else
                                        <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-slate-300 border-2 border-white rounded-full shadow-sm" title="Offline"></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $user['name'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $user['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user['role'] === 'Professional' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $user['role'] }}
                            </span>
                        </td>
                        <td class="p-5 text-sm text-slate-600">
                            {{ $user['career_interest'] ?? 'N/A' }}
                        </td>
                        <td class="p-5">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user['status'] === 'Active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $user['status'] === 'Active' ? 'bg-green-500' : 'bg-slate-400' }}"></span>
                                {{ $user['status'] }}
                            </span>
                        </td>
                        <td class="p-5 text-sm text-slate-500">
                            {{ $user['joined'] }}
                        </td>
                        <td class="p-5 text-right">
                            <button class="text-slate-400 hover:text-indigo-600 transition-colors p-2 rounded-full hover:bg-slate-100">
                                <span class="sr-only">Edit</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between items-center text-sm text-slate-500">
            <div>Showing 1 to {{ count($users) }} of {{ count($users) }} results</div>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-white disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-white disabled:opacity-50" disabled>Next</button>
            </div>
        </div>
    </div>
@endsection
