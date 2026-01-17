@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Action Center</h1>
        <p class="text-slate-500 mt-1">Manage communications and content publication from a single hub.</p>
    </div>

    <!-- Main Container with Alpine Magic -->
    <div x-data="actionManager()">

        <!-- Tabs -->
        <div class="flex space-x-1 bg-slate-200 p-1 rounded-xl mb-6 w-fit">
            <button
                @click="mode = 'email'"
                :class="mode === 'email' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-800'"
                class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Send News / Email
            </button>
            <button
                @click="mode = 'program'"
                :class="mode === 'program' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-800'"
                class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manage Programs
            </button>
            <button
                @click="mode = 'general'"
                :class="mode === 'general' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-800'"
                class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Strategic Insights (AI)
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT COLUMN: Context/Config -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Email Context -->
                <div x-show="mode === 'email'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-6">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 text-indigo-600">Target Audience</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">User Role</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" checked class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                                        <span class="text-sm text-slate-600">Student</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                                        <span class="text-sm text-slate-600">Professional</span>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-100">
                                <div class="flex justify-between items-center bg-indigo-50 p-3 rounded-lg border border-indigo-100">
                                    <span class="text-sm font-medium text-indigo-900">Recipients</span>
                                    <span class="text-lg font-bold text-indigo-600">428</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AI Topic Selection -->
                     <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 flex items-center gap-2">
                             <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            AI Content Generator
                        </h3>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Campaign Topic</label>
                            <p class="text-xs text-slate-400 mb-2">Select a topic for AI to draft the email.</p>
                            <select x-model="email.topic" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm mb-4">
                                <option value="Maintenance">Platform Maintenance</option>
                                <option value="Internship">New Internships</option>
                                <option value="Event">Upcoming Webinar/Event</option>
                                <option value="General">General Update</option>
                            </select>

                            <label class="block text-sm font-medium text-slate-700 mb-2">Schedule Sending</label>
                            <input type="datetime-local" x-model="email.schedule" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm mb-4">

                            <button @click="generateEmail()" class="w-full px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Generate Email Draft
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Content Context -->
                <!-- Program Context -->
                <div x-show="mode === 'program'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 text-purple-600">Program Settings</h3>
                        <p class="text-xs text-slate-400 mb-4">Configure program logistics and metadata.</p>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Program Type</label>
                                <select x-model="program.type" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm">
                                    <option value="Course">Online Course</option>
                                    <option value="Workshop">Live Workshop</option>
                                    <option value="Webinar">Webinar Series</option>
                                    <option value="Mentorship">Mentorship Grouo</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Primary Facilitator</label>
                                <input type="text" x-model="program.facilitator" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm" placeholder="e.g. Dr. Jane Smith">
                            </div>

                            <div class="bg-purple-50 p-4 rounded-xl border border-purple-100 mt-4">
                                <h4 class="text-sm font-bold text-purple-800 mb-2 flex items-center gap-2">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    AI Assistant
                                </h4>
                                <p class="text-xs text-purple-600 mb-3">Generate a course description based on title.</p>
                                <button @click="generateProgramAI()" class="w-full py-2 bg-white border border-purple-200 text-purple-700 rounded-lg text-xs font-bold hover:bg-purple-100 transition-colors">
                                    Generate Description
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- General Content Context with AI -->
                <div x-show="mode === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 text-blue-600">AI Content Generator</h3>
                        <p class="text-xs text-slate-400 mb-4">Generate insights from external sources.</p>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-slate-700 mb-2 block">Source Type</label>
                                <div class="flex bg-slate-100 p-1 rounded-lg">
                                    <button @click="content.sourceType = 'link'" :class="content.sourceType === 'link' ? 'bg-white shadow text-slate-800' : 'text-slate-500'" class="flex-1 py-1 text-xs font-semibold rounded text-center transition-all">Link / URL</button>
                                    <button @click="content.sourceType = 'file'" :class="content.sourceType === 'file' ? 'bg-white shadow text-slate-800' : 'text-slate-500'" class="flex-1 py-1 text-xs font-semibold rounded text-center transition-all">Upload PDF</button>
                                </div>
                            </div>

                            <div x-show="content.sourceType === 'link'">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Article URL</label>
                                <input type="text" x-model="content.sourceValue" placeholder="https://example.com/article" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div x-show="content.sourceType === 'file'">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Upload Document</label>
                                <div class="border-2 border-dashed border-slate-300 rounded-lg p-3 text-center cursor-pointer hover:border-blue-500 transition-colors bg-slate-50">
                                    <span class="text-xs text-slate-500 block">Click to upload PDF</span>
                                </div>
                                <input type="hidden" x-model="content.sourceValue" value="Report.pdf">
                            </div>

                            <button @click="generateContentAI()" class="w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Generate Insight
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Editors -->
            <div class="lg:col-span-2">

                <!-- EDITOR for EMAIL -->
                <div x-show="mode === 'email'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">
                        <!-- Loading Overlay -->
                        <div x-show="loading" class="absolute inset-0 bg-white/80 z-20 flex items-center justify-center rounded-2xl backdrop-blur-sm">
                             <div class="flex flex-col items-center">
                                <svg class="animate-spin h-10 w-10 text-indigo-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-indigo-900 font-semibold animate-pulse">Generating Email...</span>
                            </div>
                        </div>

                        <div class="mb-6 border-b border-slate-100 pb-4 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-lg text-slate-800">Email Composer</h3>
                                <p class="text-sm text-slate-500">Review and edit the AI-generated draft before sending.</p>
                            </div>
                            <div x-show="email.schedule" class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                                Scheduled: <span x-text="new Date(email.schedule).toLocaleString()"></span>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Subject Line</label>
                                <input type="text" x-model="email.subject" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Message Body</label>
                                <textarea x-model="email.body" rows="12" class="w-full p-4 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-y" placeholder="Content will appear here..."></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4">
                                <button class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Preview</button>
                                <button @click="sendEmailAction()" class="px-6 py-2 bg-slate-900 text-white rounded-lg font-medium hover:bg-black flex items-center gap-2 shadow-lg shadow-indigo-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                    <span x-text="email.schedule ? 'Schedule Send' : 'Send Email'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- EDITOR for PROGRAMS -->
                <div x-show="mode === 'program'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">

                         <!-- Loading Overlay -->
                         <div x-show="loading" class="absolute inset-0 bg-white/80 z-20 flex items-center justify-center rounded-2xl backdrop-blur-sm">
                            <div class="flex flex-col items-center">
                               <svg class="animate-spin h-10 w-10 text-purple-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                   <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                   <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                               </svg>
                               <span class="text-purple-900 font-semibold animate-pulse">Designing Program...</span>
                           </div>
                       </div>

                        <div class="mb-6 border-b border-slate-100 pb-4 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-lg text-slate-800">Program Manager</h3>
                                <p class="text-sm text-slate-500">Create and schedule new educational programs.</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 text-purple-700" x-text="program.type"></span>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Program Title</label>
                                <input type="text" x-model="program.title" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-lg font-semibold" placeholder="e.g. Advanced AI Workshops 2024">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Category Tag</label>
                                    <select x-model="program.category_tag" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">Select Category</option>
                                        <option value="data">Data</option>
                                        <option value="ai">AI</option>
                                        <option value="software">Software</option>
                                        <option value="management">Management</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="cybersecurity">Cybersecurity</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Price ($)</label>
                                    <input type="number" step="0.01" x-model="program.price" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Start Date & Time</label>
                                    <input type="datetime-local" x-model="program.startDate" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Registration Deadline</label>
                                    <input type="datetime-local" x-model="program.deadline" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Description / Curriculum</label>
                                <textarea x-model="program.description" rows="8" class="w-full p-4 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500" placeholder="Outline the program details here..."></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button @click="resetProgram()" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Clear / Cancel</button>
                                <button @click="createProgramAction()" class="px-6 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 flex items-center gap-2 shadow-lg shadow-purple-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    <span x-text="program.id ? 'Update Program' : 'Create Program'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Programs List -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="font-bold text-lg text-slate-800 mb-4">Existing Programs</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-slate-100 text-slate-500 bg-slate-50/50">
                                        <th class="py-2 pl-2">Title</th>
                                        <th class="py-2">Category</th>
                                        <th class="py-2">Start Date</th>
                                        <th class="py-2 text-right pr-2">Price</th>
                                        <th class="py-2 text-right pr-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="p in programsList" :key="p.id">
                                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                                            <td class="py-3 pl-2 font-medium text-slate-900" x-text="p.title"></td>
                                            <td class="py-3"><span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-bold uppercase" x-text="p.category_tag"></span></td>
                                            <td class="py-3 text-slate-600" x-text="new Date(p.start_date).toLocaleDateString()"></td>
                                            <td class="py-3 pr-2 text-right text-slate-600 font-mono" x-text="'$' + p.price"></td>
                                            <td class="py-3 pr-2 text-right">
                                                <button @click="editProgram(p)" class="text-indigo-600 hover:text-indigo-900 text-xs font-bold px-2 py-1 rounded border border-indigo-200">Edit</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- EDITOR for GENERAL CONTENT (AI INTEGRATED) -->
                <div x-show="mode === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">

                         <!-- Loading Overlay -->
                         <div x-show="loading" class="absolute inset-0 bg-white/80 z-20 flex items-center justify-center rounded-2xl backdrop-blur-sm">
                            <div class="flex flex-col items-center">
                               <svg class="animate-spin h-10 w-10 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                   <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                   <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                               </svg>
                               <span class="text-blue-900 font-semibold animate-pulse">Researching & Writing...</span>
                           </div>
                       </div>

                        <div class="mb-6 border-b border-slate-100 pb-4">
                            <h3 class="font-bold text-lg text-slate-800">Insight Editor</h3>
                            <p class="text-sm text-slate-500">Create new strategic insights manually or via AI generation.</p>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Headline</label>
                                <input type="text" x-model="general.title" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-semibold">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Category</label>
                                    <select x-model="general.category" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="market_data">Market Data</option>
                                        <option value="case_studies">Case Studies</option>
                                        <option value="latest">Latest Trends</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Read Time</label>
                                    <input type="text" x-model="general.read_time" placeholder="e.g. 5 min read" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Content Body</label>
                                <textarea x-model="general.body" rows="12" class="w-full p-4 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-mono text-sm" placeholder="Write your content here..."></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button @click="resetGeneral()" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Clear / Cancel</button>
                                <button @click="publishGeneralAction()" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 flex items-center gap-2 shadow-lg shadow-blue-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                    <span x-text="general.id ? 'Update Content' : 'Publish'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Existing General Content List -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h3 class="font-bold text-lg text-slate-800 mb-4">Published Content</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-slate-100 text-slate-500 bg-slate-50/50">
                                        <th class="py-2 pl-2">Title</th>
                                        <th class="py-2">Category</th>
                                        <th class="py-2">Visibility</th>
                                        <th class="py-2 text-right pr-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="g in generalList" :key="g.id">
                                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                                            <td class="py-3 pl-2 font-medium text-slate-900" x-text="g.title"></td>
                                            <td class="py-3"><span class="px-2 py-1 rounded bg-blue-50 text-blue-700 text-xs font-bold" x-text="g.category"></span></td>
                                            <td class="py-3 text-slate-600 capitalize flex items-center gap-1">
                                                <span :class="g.visibility === 'public' ? 'bg-green-400' : 'bg-amber-400'" class="w-2 h-2 rounded-full"></span>
                                                <span x-text="g.visibility"></span>
                                            </td>
                                        <td class="py-3 pr-2 text-right">
                                            <button @click="editGeneral(g)" class="text-indigo-600 hover:text-indigo-900 text-xs font-bold px-2 py-1 rounded border border-indigo-200">Edit</button>
                                        </td>
                                    </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Detailed Action History Table -->
        <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-lg text-slate-800">Recent Activity Logs</h3>
                <span class="text-xs font-semibold text-slate-500 bg-white px-3 py-1 rounded-full border border-slate-200 shadow-sm" x-text="logs.length + ' Actions'"></span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Action Description</th>
                            <th class="px-6 py-3">Scheduled / Time</th>
                            <th class="px-6 py-3 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-if="logs.length === 0">
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-400 italic">No activity recorded for this session.</td>
                            </tr>
                        </template>
                        <template x-for="log in logs" :key="log.id">
                            <tr class="hover:bg-slate-50 transition-colors cursor-pointer group" @click="viewLogDetail(log)">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="{
                                        'bg-indigo-100 text-indigo-700 border-indigo-200': log.type === 'email',
                                        'bg-emerald-100 text-emerald-700 border-emerald-200': log.type === 'content',
                                        'bg-purple-100 text-purple-700 border-purple-200': log.type === 'program',
                                        'bg-blue-100 text-blue-700 border-blue-200': log.type === 'general'
                                    }" class="px-3 py-1 rounded-full text-xs font-bold border flex items-center gap-1 w-fit">
                                        <span x-text="{
                                            'email': 'EMAIL CAMPAIGN',
                                            'content': 'CONTENT POST',
                                            'program': 'PROGRAM',
                                            'general': 'GENERAL CONTENT'
                                        }[log.type]"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-800 group-hover:text-indigo-600 transition-colors">
                                    <span x-text="log.action"></span>
                                    <span class="text-xs text-slate-400 block font-normal mt-0.5" x-text="'Click to view details'"></span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-mono text-xs" x-text="log.time"></td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2 py-1 rounded text-xs font-semibold">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Completed
                                    </span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Log Detail Modal -->
        <div x-show="selectedLog" class="fixed inset-0 z-50 flex items-center justify-center px-4" x-cloak>
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"
                 x-show="selectedLog"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="selectedLog = null"></div>

            <!-- Modal Panel -->
            <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[80vh] overflow-y-auto relative z-10 transform transition-all"
                 x-show="selectedLog"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <div class="p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span :class="{
                                'bg-indigo-100 text-indigo-700': selectedLog?.type === 'email',
                                'bg-emerald-100 text-emerald-700': selectedLog?.type === 'content',
                                'bg-purple-100 text-purple-700': selectedLog?.type === 'program',
                                'bg-blue-100 text-blue-700': selectedLog?.type === 'general'
                            }" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block">
                                <span x-text="{
                                    'email': 'Email Campaign',
                                    'content': 'Content Post',
                                    'program': 'Program',
                                    'general': 'General Content'
                                }[selectedLog?.type]"></span>
                            </span>
                            <h3 class="text-xl font-bold text-slate-900" x-text="selectedLog?.action"></h3>
                            <p class="text-sm text-slate-500 mt-1" x-text="selectedLog?.time"></p>
                        </div>
                        <button @click="selectedLog = null" class="text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 p-2 rounded-full hover:bg-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="prose prose-sm max-w-none text-slate-600 bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <div x-html="selectedLog?.details"></div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button @click="selectedLog = null" class="px-5 py-2.5 bg-slate-900 text-white rounded-lg font-medium hover:bg-slate-800 transition-colors">Close Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Logic -->
    <script>
        function actionManager() {
            return {
                mode: 'email', // 'email', 'content', 'program', 'general'
                loading: false,
                email: {
                    topic: 'Maintenance',
                    subject: '',
                    body: '',
                    schedule: ''
                },
                content: {
                   sourceType: 'link', // 'link' or 'file'
                   sourceValue: '',
                },
                program: {
                    id: null,
                    type: 'Course',
                    title: '',
                    facilitator: '',
                    startDate: '',
                    deadline: '',
                    capacity: '',
                    points: 50,
                    description: '',
                    price: '', // Added for binding
                    category_tag: '' // Added for binding
                },
                general: {
                    id: null,
                    category: 'Notice',
                    visibility: 'public',
                    tags: '',
                    title: '',
                    body: '',
                    read_time: '', // Added for binding
                    previewMode: true
                },
                programsList: @json($programs),
                generalList: @json($insights),
                selectedLog: null,
                logs: [
                    {
                        id: 1,
                        type: 'email',
                        action: 'Sent: Platform Update',
                        time: '2 hours ago',
                        details: '<p><strong>Subject:</strong> Scheduled Maintenance<br>Dear Users, we will be performing maintenance this Saturday at 2 AM EST.</p>'
                    },
                    {
                        id: 2,
                        type: 'content',
                        action: 'Published: AI Trends',
                        time: '1 day ago',
                        details: '<h3>The Future of AI</h3><p>An in-depth look at how generative models are reshaping the creative industry.</p>'
                    },
                    {
                        id: 3,
                        type: 'program',
                        action: 'Created: Summer Internship',
                        time: '2 days ago',
                        details: '<h3>Summer Internship 2024</h3><p><strong>Type:</strong> Workshop</p><p>A comprehensive program for new graduates.</p>'
                    },
                    {
                        id: 4,
                        type: 'general',
                        action: 'Posted: Holiday Policy',
                        time: '3 days ago',
                        details: '<h3>Holiday Leave Policy</h3><p>Updates regarding the upcoming holiday season office closures.</p>'
                    }
                ],

                async generateEmail() {
                    this.loading = true;
                    try {
                        const response = await fetch('{{ route("admin.generate.email") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                topic: this.email.topic
                            })
                        });
                        const data = await response.json();
                        this.email.subject = data.subject;
                        this.email.body = data.body;
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to generate AI content');
                    } finally {
                        this.loading = false;
                    }
                },

                async generateContentAI() {
                    if(this.content.sourceType === 'file' && !this.content.sourceValue) {
                        this.content.sourceValue = 'Future_of_AI_Report_2024.pdf';
                    }

                    this.loading = true;
                    try {
                        const response = await fetch('{{ route("admin.generate.content") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                source_type: this.content.sourceType,
                                source_value: this.content.sourceValue
                            })
                        });
                        const data = await response.json();
                        // Populate General fields
                        this.general.title = data.title;
                        this.general.body = data.content; // Use content as body HTML
                        this.general.category = 'latest'; // Default
                        this.general.read_time = '5 min read'; // Default estimate

                        alert('AI has successfully drafted the insight!');
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to generate AI content');
                    } finally {
                        this.loading = false;
                    }
                },

                async generateProgramAI() {
                     if(!this.program.title) {
                         alert('Please enter a Program Title first');
                         return;
                     }

                     this.loading = true;
                     try {
                        const response = await fetch('{{ route("admin.generate.program") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                title: this.program.title,
                                category_tag: this.program.category_tag
                            })
                        });
                        const data = await response.json();
                        this.program.description = data.description;
                        alert('Program description generated!');
                     } catch (e) {
                         alert('AI Generation failed');
                     } finally {
                         this.loading = false;
                     }
                },

                sendEmailAction() {
                    if(!this.email.subject || !this.email.body) {
                        alert('Please generate the email content first.');
                        return;
                    }

                    const actionText = this.email.schedule
                        ? `Scheduled Email: "${this.email.subject}"`
                        : `Sent Email: "${this.email.subject}"`;

                    alert(this.email.schedule
                        ? `Email scheduled successfully for ${new Date(this.email.schedule).toLocaleString()}`
                        : 'Email sent successfully to 428 recipients!');

                    this.addLog('email', actionText);

                    this.email.subject = '';
                    this.email.body = '';
                    this.email.schedule = '';
                },




                editProgram(p) {
                    this.program = {
                        id: p.id,
                        type: 'Course', // Default or could limit
                        title: p.title,
                        facilitator: '', // Not in DB yet
                        startDate: p.start_date,
                        deadline: '',   // Not in DB yet
                        capacity: '',   // Not in DB yet
                        points: 50,
                        description: p.description,
                        price: p.price,
                        category_tag: p.category_tag
                    };
                    // Scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                editGeneral(g) {
                    this.general = {
                        id: g.id,
                        category: g.category,
                        visibility: g.visibility || 'public',
                        tags: '',
                        title: g.title,
                        body: g.body || '',
                        read_time: g.read_time,
                        previewMode: true
                    };
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                async createProgramAction() {
                    if(!this.program.title || !this.program.description) {
                         alert('Please fill in the program details.');
                         return;
                    }

                    if (this.program.id) {
                        // UPDATE Logic
                        try {
                            const response = await fetch(`/admin/programs/${this.program.id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    title: this.program.title,
                                    description: this.program.description,
                                    price: this.program.price,
                                    start_date: this.program.startDate,
                                    category_tag: this.program.category_tag
                                })
                            });
                            if (response.ok) {
                                alert('Program updated successfully!');
                                location.reload();
                                return;
                            }
                        } catch (e) { console.error(e); }
                    } else {
                        // CREATE Logic
                        try {
                            const response = await fetch('{{ route("admin.programs.store") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    title: this.program.title,
                                    description: this.program.description,
                                    price: this.program.price,
                                    start_date: this.program.startDate,
                                    category_tag: this.program.category_tag
                                })
                            });
                             if (response.ok) {
                                alert('Program created successfully!');
                                location.reload();
                                return;
                            }
                        } catch (e) { console.error(e); }
                    }

                    alert('Action failed or incomplete form.');
                },

                async publishGeneralAction() {
                     if(!this.general.title) {
                        alert('Please fill in the content details.');
                        return;
                    }

                    const payload = {
                        title: this.general.title,
                        category: this.general.category,
                        body: this.general.body,
                        read_time: this.general.read_time
                    };

                    if (this.general.id) {
                        // UPDATE
                        try {
                            const response = await fetch(`/admin/insights/${this.general.id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify(payload)
                            });
                            if (response.ok) {
                                alert('Insight updated successfully!');
                                location.reload();
                                return;
                            }
                        } catch (e) { alert('Error updating insight.'); return; }
                    } else {
                        // CREATE
                        try {
                            const response = await fetch('{{ route("admin.insights.store") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify(payload)
                            });
                            if (response.ok) {
                                alert('Insight created successfully!');
                                location.reload();
                                return;
                            }
                        } catch (e) { alert('Error creating insight.'); return; }
                    }

                    alert('Action failed.');
                },

                addLog(type, action) {
                    let details = '';
                    if (type === 'email') {
                         details = `<p><strong>Subject:</strong> ${this.email.subject}</p><div>${this.email.body.replace(/\n/g, '<br>')}</div>`;
                    } else if (type === 'content') {
                         details = `<h3>${this.content.title}</h3><p>${this.content.summary || this.content.body.substring(0, 100) + '...'}</p>`;
                    } else if (type === 'program') {
                         details = `<h3>${this.program.title}</h3><p><strong>Type:</strong> ${this.program.type}</p><p>${this.program.description}</p>`;
                    } else if (type === 'general') {
                         details = `<h3>${this.general.title}</h3><p><strong>Category:</strong> ${this.general.category}</p><div>${this.general.body.substring(0, 100) + '...'}</div>`;
                    }

                    this.logs.unshift({
                        id: Date.now(),
                        type: type,
                        action: action,
                        time: 'Just now',
                        details: details
                    });
                }
            }
        }
    </script>
@endsection
