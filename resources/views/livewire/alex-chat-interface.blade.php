<div class="w-full h-[500px] max-h-[80vh] flex flex-col justify-between bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-200"
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
            await new Promise(r => setTimeout(r, 2200));
            this.isTyping = false;
            this.visibleMessages = 1;
            this.$nextTick(() => this.scrollToInContainer(this.$refs.msg1));

            // Msg 2: Founder / Hate Lost (Merged)
            this.isTyping = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
            await new Promise(r => setTimeout(r, 3500));
            this.isTyping = false;
            this.visibleMessages = 2;
            this.$nextTick(() => this.scrollToInContainer(this.$refs.msg2));

             // Msg 3: Vibe check
            this.isTyping = true;
            this.scrollToInContainer(this.$refs.chatContainer.lastElementChild);
            await new Promise(r => setTimeout(r, 2500));
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

            // Watch for new steps (messages from Alex)
            this.$watch('step', (val) => {
                this.showOptions = false; // Hide options while new messages load

                // If final step, redirect
                if (val === 5) {
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
                    <img src="https://ui-avatars.com/api/?name=Alex&background=e0e7ff&color=4f46e5&bold=true" class="w-full h-full rounded-full object-cover" alt="Alex">
                </div>
            </div>
            <div>
                <h3 class="font-bold text-white text-sm leading-tight">Alex</h3>
                <p class="text-[11px] text-indigo-200 font-medium leading-tight tracking-wide">Career Architect</p>
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
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                    Hey! Alex here. 👋
                </div>
            </div>
            <!-- Msg 2 -->
             <div x-ref="msg2" x-show="visibleMessages >= 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                   I'm the Founder/CEO. <br>
                   I hate seeing talented people get lost here, so I want to help.
                </div>
            </div>
            <!-- Msg 3 -->
             <div x-ref="msg3" x-show="visibleMessages >= 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                   Quick vibe check?
                </div>
            </div>
        </div>

        <!-- NODE B: Vibe Check -->
        @if($step >= 1)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    Go for it.
                </div>
            </div>

            <!-- Alex Question -->
            <div class="space-y-2">
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 800)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        Be honest with me.
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); setTimeout(() => { showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 1000) }) }, 3000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        How’s your career feeling right now?
                    </div>
                </div>
            </div>
        @endif

        <!-- NODE C: Validation -->
        @if($step >= 2)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    @if($userStatus == 'stuck') 🛑 Kinda stuck. (I need a change).
                    @else 🚀 Good, but I want MORE. @endif
                </div>
            </div>

            <!-- Alex Response -->
            <div class="space-y-2">
                @if($userStatus == 'stuck')
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            I feel that.
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2200)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            Seriously, I talk to 50 people a week who feel the exact same way.
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 4200)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            It just means you've outgrown your current spot. That’s actually a good thing.
                        </div>
                    </div>
                @else
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            Love that energy. ⚡
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2200)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                            Never settle, right?
                        </div>
                    </div>
                @endif

                <!-- Common Follow-up -->
                <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 6000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        Let’s fast forward 6 months. ⏩
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => { scrollToInContainer($el); setTimeout(() => { showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 1000) }) }, 8000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                        If you could wake up with a new "Superpower," what is it?
                    </div>
                </div>
            </div>
        @endif

        <!-- NODE D: The Hook -->
        @if($step >= 3)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    @if($careerInterest == 'data') 📊 Predicting the future (Data).
                    @elseif($careerInterest == 'ai') 🤖 Building AI (Tech).
                    @else 💻 Coding Apps (Software). @endif
                </div>
            </div>

            <!-- Alex Response -->
            <div class="space-y-2">
                @if($careerInterest == 'data')
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           Data. Smart. That’s where the money is. 💰
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           You don't need a PhD, you just need a map.
                        </div>
                    </div>
                     <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 4000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           I actually wrote a <strong>"Zero-to-Hero Roadmap"</strong> for this.
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 5500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           It cuts out the boring stuff. Just the skills you need to get hired.
                        </div>
                    </div>
                    <!--- Final Data Msg -->
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 7000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                            Want me to email it to you? (It's free).
                        </div>
                    </div>
                @else
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           Solid choice. The world runs on code now. 🌎
                        </div>
                    </div>
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                         <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           I have a <strong>"Survival Guide"</strong> for that.
                        </div>
                    </div>
                     <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 4000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                           It skips the theory and shows you what startups actually use.
                        </div>
                    </div>
                    <!--- Final Software Msg -->
                    <div x-data="{show: false}" x-init="setTimeout(() => { show=true; showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 5500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                        <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                        <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed font-semibold">
                            Want me to email it to you? (It's free).
                        </div>
                    </div>
                @endif
            </div>
        @endif

         <!-- NODE E: The Exchange -->
         @if($step >= 4)
            <!-- User Reply -->
            <div class="flex items-end justify-end space-x-2 animate-message">
                <div class="bg-indigo-600 text-white py-2 px-3 rounded-2xl rounded-br-none text-sm shadow-md">
                    Yeah, send it! 📧
                </div>
            </div>

             <!-- Alex Response -->
             <div class="space-y-2">
                <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 1000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                    <img class="w-6 h-6 rounded-full mb-1 shadow-sm" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        You got it. Drop your email and I’ll fire it over.
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 2500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        (I promise, no spam. I'm too busy for that lol).
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
                        Sent! 📨
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; $nextTick(() => scrollToInContainer($el)) }, 2200)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        Check your inbox in a sec.
                    </div>
                </div>
                 <div x-data="{show: false}" x-init="setTimeout(() => { show=true; showOptions = true; $nextTick(() => scrollToInContainer($el)) }, 3500)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex items-end space-x-2">
                     <img class="w-6 h-6 rounded-full mb-1 shadow-sm opacity-0" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff" alt="Alex">
                    <div class="bg-white py-2 px-3 rounded-2xl rounded-bl-none text-sm text-slate-700 shadow-sm border border-slate-100 max-w-[85%] md:max-w-[380px] leading-relaxed">
                        While you wait... I actually customized the whole site for you.
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
                    <button wire:click="startChat" class="py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 block w-full">
                        Go for it.
                    </button>
                    <button class="text-xs text-center text-gray-400 hover:text-gray-600 py-1 block w-full">
                        Just looking.
                    </button>
                </div>
            @endif

            <!-- Step 1: Status Options -->
            @if($step === 1)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="setStatus('stuck')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        🛑 Kinda stuck. (I need a change).
                    </button>
                    <button wire:click="setStatus('good')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        🚀 Good, but I want MORE.
                    </button>
                </div>
            @endif

            <!-- Step 2: Path Options -->
            @if($step === 2)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="setInterest('data')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                        📊 Predicting the future (Data).
                    </button>
                    <button wire:click="setInterest('ai')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                         🤖 Building AI (Tech).
                    </button>
                    <button wire:click="setInterest('software')" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-700 transition-all text-left block w-full shadow-sm">
                         💻 Coding Apps (Software).
                    </button>
                </div>
            @endif

            <!-- Step 3: Bait Options -->
            @if($step === 3)
                <div class="grid grid-cols-1 gap-2">
                    <button wire:click="acceptOffer" class="py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 block w-full">
                        Yeah, send it! 📧
                    </button>
                    <button wire:click="declineOffer" class="text-xs text-center text-gray-400 hover:text-gray-600 py-1 block w-full">
                        Nah, I'm good.
                    </button>
                </div>
            @endif
        </div>

        <!-- Persistent Fake Input Bar (Always hidden if step 4 active, because step 4 has real form) -->
        <div class="p-3" x-show="step < 4">
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
        <div x-show="step === 4" class="p-3"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
             <form wire:submit.prevent="submitLead" class="flex gap-2">
                <input type="email" wire:model="email" placeholder="name@example.com" required
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
