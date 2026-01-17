<div class="w-full h-[500px] max-h-[80vh] flex flex-col justify-between bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-200"
    x-on:reveal-options="showOptions = true"
    x-data="{
        step: @entangle('step'),
        isTyping: false,
        showOptions: false,
        visibleMessages: 0,

        scrollToBottom() {
             setTimeout(() => {
                const container = this.$refs.chatContainer;
                if (container) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }, 100);
        },

        async playIntro() {
            // Msg 1: Hey
            this.isTyping = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
            await new Promise(r => setTimeout(r, 800));
            this.isTyping = false;
            this.visibleMessages = 1;
            this.$nextTick(() => this.scrollToInContainer(this.$refs.msg1));

            // Msg 2: Value Prop
            this.isTyping = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
            await new Promise(r => setTimeout(r, 1500));
            this.isTyping = false;
            this.visibleMessages = 2;
            this.$nextTick(() => this.scrollToInContainer(this.$refs.msg2));

             // Msg 3: Call to Action
            this.isTyping = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
            await new Promise(r => setTimeout(r, 1200));
            this.isTyping = false;
            this.visibleMessages = 3;
            this.$nextTick(() => this.scrollToInContainer(this.$refs.msg3));

            // Reveal Options
            this.showOptions = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
        },

        scrollToElement(el) {
           this.scrollToInContainer(el);
        },

        scrollToInContainer(el) {
            const container = this.$refs.chatContainer;
            if (container && el) {
                const containerRect = container.getBoundingClientRect();
                const elRect = el.getBoundingClientRect();

                // Robust calculation using getBoundingClientRect
                // This avoids issues with offsetParent and ensures exact positioning locally
                const relativeTop = elRect.top - containerRect.top;
                const currentScroll = container.scrollTop;
                const absoluteTop = currentScroll + relativeTop;

                // Scroll to center the element in the container
                // absoluteTop is the top pixel of the element in the scrollable content
                // We want that pixel to be at the middle of the container: (containerHeight / 2)
                // minus half the element height for perfect centering
                const targetScroll = absoluteTop - (container.clientHeight / 2) + (elRect.height / 2);

                container.scrollTo({
                    top: targetScroll,
                    behavior: 'smooth'
                });
            }
        },

        init() {
            // Animations
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
                .animate-message { opacity: 0; animation: fadeInUp 0.5s ease-out forwards; }
            `;
            document.head.appendChild(style);

            if (this.step === 0) {
                this.playIntro();
            } else {
                this.visibleMessages = 5;
                this.showOptions = true;
            }

            // Watch for new steps (messages from Alex) to trigger options visibility
            this.$watch('step', (val) => {
                this.showOptions = false; // Reset initially

                // Calculate total delay based on the longest message animation in the new step
                let delay = 0;

                // Step 1: student/pro (Msg at 600ms, Question at 1500ms) -> Show at ~2300ms
                if (val == 1) delay = 2300;

                // Step 2: status reply (Msg at 600ms, Question at 1500ms) -> Show at ~2300ms
                if (val == 2) delay = 2300;

                // Step 3: career reply (Msg at 600ms, Plan at 1800ms, Question at 3000ms) -> Show at ~3800ms
                if (val == 3) delay = 3800;

                // Step 4: Email capture (Msg at 1000ms, Promise at 2500ms) -> Show at ~3300ms
                if (val == 4) delay = 3300;

                if (delay > 0) {
                     setTimeout(() => {
                        this.showOptions = true;
                        this.$nextTick(() => this.scrollToBottom());
                    }, delay);
                }

                // If final step, redirect
                if (val == 5) {
                    setTimeout(() => {
                         window.location.href = '/home';
                    }, 5000);
                }
            });

            // Watch for typing status changes
            this.$watch('isTyping', (val) => {
                // if(val) this.scrollToBottom(); // Disable auto-scroll logic
            });

            // Hook into Livewire lifecycle
            Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
                this.isTyping = true;
                // this.scrollToBottom(); // Disable

                succeed(({ snapshot, effect }) => {
                    // this.scrollToBottom(); // Disable
                    setTimeout(() => {
                        this.isTyping = false;
                        // this.$nextTick(() => {
                        //      setTimeout(() => this.scrollToBottom(), 150); // Disable
                        // });
                    }, 500); // Short delay before revealing
                })

                fail(() => { this.isTyping = false; })
            })
        }
    }">

    <!-- Chat Header -->
    <div class="flex items-center justify-between bg-indigo-600 px-5 py-4 border-b border-indigo-700 shadow-md sticky top-0 z-10">
        <div class="flex items-center space-x-3">
             <div class="relative">
                <div class="w-2.5 h-2.5 absolute bottom-0 right-0 bg-emerald-400 rounded-full border-2 border-indigo-600 z-10"></div>
                <!-- Avatar -->
                <div class="w-10 h-10 rounded-full bg-white p-0.5 shadow-sm">
                    <img src="{{ $alexImage }}" class="w-full h-full rounded-full object-cover" alt="Alex">
                </div>
            </div>
            <div>
                <h3 class="font-bold text-white text-sm leading-tight">Alex</h3>
                <p class="text-[11px] text-indigo-200 font-medium leading-tight tracking-wide">Your Career Guide</p>
            </div>
        </div>
        <!-- Actions -->
         <div class="flex space-x-2">
            <button class="text-indigo-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"/></svg>
            </button>
            <button class="text-indigo-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Chat Messages Area -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden p-4 space-y-4 scroll-smooth custom-scrollbar bg-slate-50"
         x-ref="chatContainer">

        <!-- NODE A: Intro (Animated Sequence) -->
        <div class="space-y-4">
            <!-- Msg 1 -->
            <div x-ref="msg1" x-show="visibleMessages >= 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                    Hi! I'm Alex, your personal career guide. 👋
                </div>
            </div>
            <!-- Msg 2 -->
             <div x-ref="msg2" x-show="visibleMessages >= 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="{{ $alexImage }}" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                   I know figuring out your next step can be overwhelming. I'm here to build a custom roadmap just for you.
                </div>
            </div>
            <!-- Msg 3 -->
             <div x-ref="msg3" x-show="visibleMessages >= 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="{{ $alexImage }}" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-bold">
                   Shall we start building your custom path?
                </div>
            </div>
        </div>

        <!-- NODE B: Vibe Check -->
        @if($step >= 1)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    Yes, build my roadmap! 🚀
                </div>
            </div>

            <!-- Alex Question -->
            <div class="space-y-2">
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        Awesome! To get started, tell me a bit about where you are right now.
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); }) }, 1500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="{{ $alexImage }}" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        Are you currently studying, or are you already in the workforce?
                    </div>
                </div>
            </div>
        @endif

        <!-- NODE C: Validation -->
        @if($step >= 2)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    @if($userStatus == 'student') 🎓 I'm currently studying.
                    @else 💼 I'm working professionally. @endif
                </div>
            </div>

            <!-- Alex Response -->
            <div class="space-y-2">
                @if($userStatus == 'student')
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            That's such an exciting time! 🎓 Getting that first big break is all about the right skills.
                        </div>
                    </div>
                @else
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            Got it. ⚡ Pivoting or leveling up is a smart move. Let's make sure you don't waste time.
                        </div>
                    </div>
                @endif

                <!-- Common Question -->
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); }) }, 1500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="{{ $alexImage }}" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                        Which path are you most interested in?
                    </div>
                </div>
            </div>
        @endif

        <!-- NODE D: The Hook -->
        @if($step >= 3)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    @if($careerInterest == 'data') 📊 Data Science & Analytics
                    @elseif($careerInterest == 'ai') 🤖 AI & Product Management
                    @else 💻 Software Engineering @endif
                </div>
            </div>

            <!-- Alex Response -->
            <div class="space-y-2">
                @if($careerInterest == 'data')
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           I love that choice! 📊 Data is impactful and demands curious minds like yours.
                        </div>
                    </div>
                @elseif($careerInterest == 'ai')
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           Incredible field! 🤖 AI is changing everything, and you're right on time to ride the wave.
                        </div>
                    </div>
                @else
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 600)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="{{ $alexImage }}" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           Classic potential! 💻 Building software gives you the power to create anything you can imagine.
                        </div>
                    </div>
                @endif

                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1800)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                       I've put together a <strong>personalized plan</strong> for you on the next page. It covers the specific skills you need.
                    </div>
                </div>

                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); }) }, 3000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                        Shall I show you the way?
                    </div>
                </div>
            </div>
        @endif

         <!-- NODE E: The Exchange -->
         @if($step >= 4)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    Yeah, show me the way! 📧
                </div>
            </div>

             <!-- Alex Response -->
             <div class="space-y-2">
                <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        I'd love to share this with you so you don't lose it. What's your best email?
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); }) }, 2500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        (I promise to only send helpful stuff. No spam ever! 🤝).
                    </div>
                </div>
            </div>
         @endif

         <!-- NODE F: The Handoff -->
          @if($step >= 5)
            <div class="space-y-2">
                <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        On its way! 🚀
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2200)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        It should be in your inbox momentarily.
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); }) }, 3500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        While that sends, I've gone ahead and personalized the dashboard just for you.
                    </div>
                </div>
                 <div class="flex items-end space-x-2 animate-message" style="animation-delay: 5500ms">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-bold">
                        Look at this. 👇
                    </div>
                </div>
            </div>
          @endif

         <!-- TYPING INDICATOR -->
         <div class="flex items-end space-x-2 animate-pulse" x-show="isTyping" style="display: none;">
            <img class="w-6 h-6 rounded-full mb-1 grayscale opacity-50" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
            <div class="bg-slate-100 py-2 px-3 rounded-2xl rounded-bl-none text-sm text-gray-400 shadow-inner flex space-x-1">
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-75"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-150"></div>
            </div>
        </div>

    </div>

    <!-- Interaction Area -->
    <div class="bg-white border-t border-slate-100 flex flex-col relative z-20"> <!-- Z-20 to sit above -->

        <!-- Options Container (Stacked ABOVE input) -->
        <div x-show="!isTyping && showOptions && step < 4"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
             class="p-2 border-b border-slate-50">
            <!-- Step 0: Intro Options -->
            @if($step === 0)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="startChat" class="py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 block w-full flex items-center justify-center gap-2">
                        Yes, build my roadmap! 🚀
                    </button>
                    <button class="text-xs text-center text-gray-400 hover:text-gray-600 py-1 block w-full">
                        Just looking around.
                    </button>
                </div>
            @endif

            <!-- Step 1: Status Options -->
            @if($step === 1)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="setStatus('student')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        🎓 I'm currently studying
                    </button>
                    <button wire:click="setStatus('professional')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        💼 I'm working professionally
                    </button>
                </div>
            @endif

            <!-- Step 2: Path Options -->
            @if($step === 2)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="setInterest('data')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        📊 Data Science & Analytics
                    </button>
                    <button wire:click="setInterest('ai')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                         🤖 AI & Product Management
                    </button>
                    <button wire:click="setInterest('software')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                         💻 Software Engineering
                    </button>
                </div>
            @endif

            <!-- Step 3: Bait Options -->
            @if($step === 3)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="acceptOffer" class="py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 block w-full">
                        Yes, show me the way! 🚀
                    </button>
                    <button wire:click="declineOffer" class="text-xs text-center text-gray-400 hover:text-gray-600 py-1 block w-full">
                        No thanks, I'll browse on my own.
                    </button>
                </div>
            @endif
        </div>

        <!-- Persistent Fake Input Bar (Always hidden if step 4 active, because step 4 has real form) -->
        <div class="p-3" x-show="step < 4 || (step == 4 && !showOptions)" style="{{ $step > 4 ? 'display: none;' : '' }}">
             <div class="flex items-center space-x-2 bg-slate-50 border border-slate-200 rounded-xl p-2 opacity-60"> <!-- Opacity to show disabled state -->
                 <div class="text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                </div>
                <div class="flex-1 text-sm text-slate-400 italic bg-transparent">
                     Type a message...
                </div>
                 <div class="text-indigo-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </div>
            </div>
        </div>

        <!-- Step 4: Capture Form (This replaces everything in this block) -->
        <div x-show="step == 4 && showOptions" class="p-3" style="{{ $step == 4 ? '' : 'display: none;' }}"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
             <form wire:submit.prevent="submitLead" class="flex gap-2">
                <input type="text" wire:model="email" placeholder="Where should I send it? (Email)" required
                    class="w-full py-2 px-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none shadow-sm">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 font-medium transition-colors shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </form>
            @error('email') <span class="text-xs text-red-500 pl-2">{{ $message }}</span> @enderror
        </div>

        <!-- Scroll Anchor -->
        <div x-ref="bottom" class="h-4 pb-4"></div>

    </div>
</div>
