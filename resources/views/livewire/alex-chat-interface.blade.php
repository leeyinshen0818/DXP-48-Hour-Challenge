
<div class="glass-panel p-8 rounded-2xl shadow-2xl relative overflow-hidden min-h-[400px] flex flex-col justify-between">

    <!-- Chat Header with Pulse Indicator -->
    <div class="flex items-center space-x-3 border-b border-gray-100 pb-4 mb-4">
        <div class="relative">
            <span class="block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
            <span class="absolute top-0 right-0 w-3 h-3 bg-green-400 rounded-full animate-ping opacity-75"></span>
        </div>
        <div>
            <h3 class="font-bold text-gray-800">Alex (Career Mentor)</h3>
            <p class="text-xs text-gray-500">Active now • Replies instantly</p>
        </div>
    </div>

    <!-- Chat Messages Area -->
    <div class="flex-1 overflow-y-auto space-y-4 mb-6 pr-2">

        <!-- Step 1: The Opener -->
        @if($step >= 0)
            <div class="flex items-start space-x-3 animate-fade-in-up">
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-gray-100 p-3 rounded-2xl rounded-tl-none text-sm text-gray-700 shadow-sm max-w-[85%]">
                    Hey! 👋 No wrong answers here... when you think about your future right now, what’s the honest feeling?
                </div>
            </div>
        @endif

        <!-- User Reply 1 -->
        @if($vibe)
            <div class="flex items-start justify-end space-x-3 animate-fade-in-up">
                <div class="bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none text-sm shadow-md">
                    {{ ucfirst($vibe) }}
                </div>
            </div>
        @endif

        <!-- Step 2: Empathy + Diagnosis -->
        @if($step >= 1)
            <div class="flex items-start space-x-3 mt-4 animate-fade-in-up delay-300">
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-gray-100 p-3 rounded-2xl rounded-tl-none text-sm text-gray-700 shadow-sm max-w-[85%]">
                    I appreciate the honesty. Seriously, you aren't alone in feeling that. <br><br>
                    Let's find a path forward. If you could have one "superpower" in 6 months, what would it be?
                </div>
            </div>
        @endif

        <!-- User Reply 2 -->
        @if($goal)
            <div class="flex items-start justify-end space-x-3 animate-fade-in-up">
                <div class="bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none text-sm shadow-md">
                   I want to learn: {{ ucfirst($goal) }}
                </div>
            </div>
        @endif

         <!-- Step 3: Capture -->
         @if($step >= 2)
            <div class="flex items-start space-x-3 mt-4 animate-fade-in-up delay-300">
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-gray-100 p-3 rounded-2xl rounded-tl-none text-sm text-gray-700 shadow-sm max-w-[85%]">
                    Got it. We have a personalized roadmap for <strong>{{ ucfirst($goal) }}</strong> leaders. <br><br>
                    Where should I send your access link?
                </div>
            </div>
        @endif

    </div>

    <!-- Interaction Area -->
    <div class="pt-4 border-t border-gray-100">

        <!-- Step 0 Options: Vibe Check -->
        @if($step === 0)
            <div class="grid grid-cols-2 gap-3">
                <button wire:click="setVibe('stuck')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all text-left group">
                    😔 honestly? stuck.
                </button>
                <button wire:click="setVibe('curious')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all text-left group">
                    🤔 just curious
                </button>
                <button wire:click="setVibe('ambitious')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all text-left group">
                   🚀 ready to grow
                </button>
                 <button wire:click="setVibe('evaluating')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all text-left group">
                   👀 evaluating options
                </button>
            </div>
        @endif

        <!-- Step 1 Options: Goals -->
        @if($step === 1)
            <div class="grid grid-cols-1 gap-2">
                <button wire:click="setGoal('data')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all flex items-center">
                    📊 Making sense of Data (Data Science)
                </button>
                <button wire:click="setGoal('management')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all flex items-center">
                    👔 Leading People (Management)
                </button>
                <button wire:click="setGoal('marketing')" class="p-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 transition-all flex items-center">
                    📣 Digital Growth (Marketing)
                </button>
            </div>
        @endif

        <!-- Step 2 Input: Email Capture -->
        @if($step === 2)
            <form wire:submit.prevent="submitLead" class="flex gap-2">
                <input type="email" wire:model="email" placeholder="name@example.com" required
                    class="w-full p-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 font-medium transition-colors">
                    Start
                </button>
            </form>
            @error('email') <span class="text-xs text-red-500 pl-2">{{ $message }}</span> @enderror
        @endif

    </div>
</div>
