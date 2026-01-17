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
                @click="mode = 'content'"
                :class="mode === 'content' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-800'"
                class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Publish AI Content
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
                General Content
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
                <div x-show="mode === 'content'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 text-emerald-600">Source Material</h3>
                        <p class="text-sm text-slate-500 mb-4">Provide a source for AI to summarize and format.</p>

                        <div class="space-y-4">
                            <!-- Type & Schedule Configuration -->
                            <div class="grid grid-cols-1 gap-4 bg-slate-50 p-3 rounded-lg border border-slate-100 mb-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1 uppercase tracking-wider">Content Type</label>
                                    <select x-model="content.type" class="w-full border-slate-200 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-1.5">
                                        <option value="Article">Article / Blog</option>
                                        <option value="News">News Announcement</option>
                                        <option value="Tutorial">Tutorial / Guide</option>
                                        <option value="Video">Video Summary</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1 uppercase tracking-wider">Schedule Publish</label>
                                    <input type="datetime-local" x-model="content.schedule" class="w-full border-slate-200 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-1.5">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-slate-700 mb-2 block">Source Type</label>
                                <div class="flex bg-slate-100 p-1 rounded-lg">
                                    <button @click="content.sourceType = 'link'" :class="content.sourceType === 'link' ? 'bg-white shadow text-slate-800' : 'text-slate-500'" class="flex-1 py-1 text-xs font-semibold rounded text-center transition-all">Link / URL</button>
                                    <button @click="content.sourceType = 'file'" :class="content.sourceType === 'file' ? 'bg-white shadow text-slate-800' : 'text-slate-500'" class="flex-1 py-1 text-xs font-semibold rounded text-center transition-all">Upload PDF</button>
                                </div>
                            </div>

                            <div x-show="content.sourceType === 'link'">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Article URL</label>
                                <input type="text" x-model="content.sourceValue" placeholder="https://example.com/article" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            </div>

                            <div x-show="content.sourceType === 'file'">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Upload Document</label>
                                <div class="border-2 border-dashed border-slate-300 rounded-lg p-4 text-center cursor-pointer hover:border-emerald-500 transition-colors bg-slate-50">
                                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <span class="text-xs text-slate-500 block">Click to upload PDF</span>
                                    <span class="text-[10px] text-slate-400 block mt-1">(Mock Upload)</span>
                                </div>
                                <!-- Pseudo-binding for the mock -->
                                <input type="hidden" x-model="content.sourceValue" value="Future_of_AI_Report_2024.pdf">
                            </div>

                            <div class="pt-2">
                                <button @click="generateContent()" class="w-full px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg hover:from-emerald-600 hover:to-teal-700 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    Process & Compose
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1 uppercase">Capacity</label>
                                    <input type="number" x-model="program.capacity" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm" placeholder="Unlimited">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1 uppercase">Points</label>
                                    <input type="number" x-model="program.points" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm" value="50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- General Content Context -->
                <div x-show="mode === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-800 mb-4 text-blue-600">Standard Content</h3>
                        <p class="text-xs text-slate-400 mb-4">Publish notices, policies, or general articles manually.</p>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Category</label>
                                <select x-model="general.category" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value="Notice">Official Notice</option>
                                    <option value="Policy">Policy Update</option>
                                    <option value="Blog">Community Blog</option>
                                    <option value="Resource">Downloadable Resource</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Visibility</label>
                                <div class="flex flex-col space-y-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="general.visibility" value="public" class="text-blue-600 focus:ring-blue-500 border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Public (Everyone)</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="general.visibility" value="internal" class="text-blue-600 focus:ring-blue-500 border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Internal (Logged In)</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="general.visibility" value="staff" class="text-blue-600 focus:ring-blue-500 border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Staff Only</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Tags</label>
                                <input type="text" x-model="general.tags" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="e.g. #important, #q1">
                            </div>
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

                <!-- EDITOR for CONTENT -->
                <div x-show="mode === 'content'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">
                         <!-- Loading Overlay -->
                         <div x-show="loading" class="absolute inset-0 bg-white/80 z-20 flex items-center justify-center rounded-2xl backdrop-blur-sm">
                            <div class="flex flex-col items-center">
                               <svg class="animate-spin h-10 w-10 text-emerald-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                   <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                   <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                               </svg>
                               <span class="text-emerald-900 font-semibold animate-pulse">Analyzing & Drafting...</span>
                           </div>
                       </div>

                        <div class="mb-6 border-b border-slate-100 pb-4 flex justify-between items-start">
                            <div class="w-3/4">
                                <h3 class="font-bold text-lg text-slate-800">Content Editor</h3>
                                <div class="flex items-center gap-2 mt-1 flex-wrap">
                                    <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 text-xs font-bold uppercase" x-text="content.type"></span>
                                    <span x-show="content.schedule" class="text-xs text-slate-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Publishes: <span x-text="new Date(content.schedule).toLocaleString()"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="text-right w-1/4" x-show="content.expectedViews > 0">
                                <span class="block text-xl md:text-2xl font-bold text-slate-900" x-text="content.expectedViews.toLocaleString()"></span>
                                <span class="text-[10px] md:text-xs font-semibold text-slate-400 uppercase tracking-wide">Est. Views</span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Title / Headline</label>
                                <input type="text" x-model="content.title" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg font-semibold">
                            </div>

                            <!-- Summary -->
                             <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Executive Summary</label>
                                <div class="bg-indigo-50/50 rounded-lg p-4 border border-indigo-100 text-sm text-slate-700 prose-sm" x-html="content.summary"></div>
                            </div>

                            <!-- Content Area -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-medium text-slate-700">Content Body</label>
                                    <div class="flex space-x-2 bg-slate-100 p-1 rounded-lg">
                                        <button @click="content.previewMode = true" :class="content.previewMode ? 'bg-white shadow text-slate-900' : 'text-slate-500'" class="px-3 py-1 text-xs font-medium rounded transition-all">Preview</button>
                                        <button @click="content.previewMode = false" :class="!content.previewMode ? 'bg-white shadow text-slate-900' : 'text-slate-500'" class="px-3 py-1 text-xs font-medium rounded transition-all">Edit HTML</button>
                                    </div>
                                </div>

                                <!-- Visual Preview -->
                                <div x-show="content.previewMode" class="w-full p-6 border border-slate-200 rounded-lg bg-white prose max-w-none max-h-[500px] overflow-y-auto">
                                    <template x-if="content.body">
                                        <div x-html="content.body"></div>
                                    </template>
                                    <template x-if="!content.body">
                                        <div class="text-slate-400 italic text-center py-10">Generated content will be previewed here.</div>
                                    </template>
                                </div>

                                <!-- Raw Editor -->
                                <textarea x-show="!content.previewMode" x-model="content.body" rows="15" class="w-full p-4 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 font-mono text-sm" placeholder="HTML content..."></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Save Draft</button>
                                <button @click="publishContentAction()" class="px-6 py-2 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 flex items-center gap-2 shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span x-text="content.schedule ? 'Schedule Publish' : 'Publish Now'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EDITOR for PROGRAMS -->
                <div x-show="mode === 'program'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
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
                                <button class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Save Draft</button>
                                <button @click="createProgramAction()" class="px-6 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 flex items-center gap-2 shadow-lg shadow-purple-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Create Program
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
                                        <th class="py-2">Type</th>
                                        <th class="py-2">Facilitator</th>
                                        <th class="py-2">Capacity</th>
                                        <th class="py-2 text-right pr-2">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="p in programsList" :key="p.id">
                                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                                            <td class="py-3 pl-2 font-medium text-slate-900" x-text="p.title"></td>
                                            <td class="py-3"><span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-bold" x-text="p.type"></span></td>
                                            <td class="py-3 text-slate-600" x-text="p.facilitator"></td>
                                            <td class="py-3 text-slate-600" x-text="p.capacity"></td>
                                            <td class="py-3 pr-2 text-right text-slate-600 font-mono" x-text="p.points"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- EDITOR for GENERAL CONTENT -->
                <div x-show="mode === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <div class="mb-6 border-b border-slate-100 pb-4">
                            <h3 class="font-bold text-lg text-slate-800">General Content Editor</h3>
                            <p class="text-sm text-slate-500">Standard rich text editor for general purpose publishing.</p>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Headline</label>
                                <input type="text" x-model="general.title" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-semibold">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Content Body</label>
                                <textarea x-model="general.body" rows="12" class="w-full p-4 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-mono text-sm" placeholder="Write your content here..."></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50">Discard</button>
                                <button @click="publishGeneralAction()" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 flex items-center gap-2 shadow-lg shadow-blue-500/20 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                    Publish
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
                                                <button class="text-slate-400 hover:text-indigo-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
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
                    type: 'Article',
                    schedule: '',
                    sourceType: 'link', // 'link' or 'file'
                    sourceValue: '',
                    title: '',
                    summary: '',
                    body: '',
                    expectedViews: 0,
                    previewMode: true, // Default to preview mode (readable)
                    editMode: false
                },
                program: {
                    type: 'Course',
                    title: '',
                    facilitator: '',
                    startDate: '',
                    deadline: '',
                    capacity: '',
                    points: 50,
                    description: ''
                },
                general: {
                    category: 'Notice',
                    visibility: 'public',
                    tags: '',
                    title: '',
                    body: ''
                },
                programsList: [
                    { id: 101, title: 'Intro to Python', type: 'Course', capacity: 200, facilitator: 'Dr. Jane Smith', points: 50 },
                    { id: 102, title: 'Career Masterclass', type: 'Webinar', capacity: 500, facilitator: 'Alex Johnson', points: 20 },
                    { id: 103, title: 'Mentorship 2024', type: 'Mentorship', capacity: 50, facilitator: 'Sarah Connor', points: 100 }
                ],
                generalList: [
                    { id: 201, title: 'Q1 Holidays', category: 'Notice', visibility: 'public' },
                    { id: 202, title: 'Code of Conduct', category: 'Policy', visibility: 'internal' },
                    { id: 203, title: 'New Resources', category: 'Resource', visibility: 'public' }
                ],
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

                async generateContent() {
                    // For file upload mock, if value is empty, set default
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
                        this.content.title = data.title;
                        this.content.summary = data.summary;
                        this.content.body = data.content;
                        this.content.expectedViews = data.expected_views;
                        this.content.previewMode = true;
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to generate AI content');
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

                publishContentAction() {
                    if(!this.content.title || !this.content.body) {
                        alert('Please generate content first.');
                        return;
                    }

                    const actionText = this.content.schedule
                        ? `Scheduled ${this.content.type}: "${this.content.title}"`
                        : `Published ${this.content.type}: "${this.content.title}"`;

                    alert(this.content.schedule
                        ? `Content scheduled successfully for ${new Date(this.content.schedule).toLocaleString()}`
                        : 'Content published successfully!');

                    this.addLog('content', actionText);

                    this.content.title = '';
                    this.content.body = '';
                    this.content.summary = '';
                    this.content.sourceValue = '';
                    this.content.schedule = '';
                    this.content.expectedViews = 0;
                },

                createProgramAction() {
                    if(!this.program.title || !this.program.description) {
                         alert('Please fill in the program details.');
                         return;
                    }

                    const actionText = `Created Program: "${this.program.title}"`;
                    alert('Program created successfully!');
                    this.addLog('program', actionText);

                    // Reset
                    this.program.title = '';
                    this.program.description = '';
                    this.program.startDate = '';
                    this.program.deadline = '';
                    this.program.facilitator = '';
                    this.program.capacity = '';
                },

                publishGeneralAction() {
                    if(!this.general.title || !this.general.body) {
                        alert('Please fill in the content details.');
                        return;
                    }

                    const actionText = `Posted: "${this.general.title}"`;
                    alert('Content posted successfully!');
                    this.addLog('general', actionText);

                    // Reset
                    this.general.title = '';
                    this.general.body = '';
                    this.general.tags = '';
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
