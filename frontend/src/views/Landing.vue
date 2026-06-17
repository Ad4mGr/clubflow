<template>
  <div class="text-gray-900 relative overflow-hidden bg-gradient-to-b from-purple-50 via-pink-50 to-orange-50">
    <!-- Animated background blobs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
      <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[bob_8s_ease-in-out_infinite]" />
      <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[bob_10s_ease-in-out_infinite_reverse]" />
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-[bob_12s_ease-in-out_infinite_2s]" />
    </div>

    <!-- Nav -->
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-white/40">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <RouterLink to="/" class="flex items-center gap-2.5">
            <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <span class="text-lg font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">ClubFlow</span>
              <div class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold -mt-0.5">student hub</div>
            </div>
          </RouterLink>
          <div class="hidden md:flex items-center gap-8">
            <a href="#features" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">features</a>
            <a href="#how" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">how it works</a>
            <a href="#pricing" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">pricing</a>
          </div>
          <div class="flex items-center gap-3">
            <RouterLink to="/login" class="hidden sm:inline-flex text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Log in</RouterLink>
            <RouterLink to="/signup" class="inline-flex bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-purple-500/30 hover:shadow-purple-500/40 hover:-translate-y-0.5">
              Join Free
            </RouterLink>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero -->
    <section class="relative overflow-hidden">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div class="relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/70 border border-white/60 text-gray-600 text-xs font-bold px-3 py-1.5 rounded-full mb-6 shadow-sm backdrop-blur-sm">
              <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse" />
              built by students, for students
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05] mb-5">
              <span class="bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400 bg-clip-text text-transparent">Stop herding cats.</span><br />
              <span>Run your club like a boss.</span>
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-lg">
              ClubFlow is the all-in-one platform that handles members, events, announcements, and tasks — so you can actually enjoy being in a club instead of drowning in DMs.
            </p>
            <div class="flex flex-wrap gap-3">
              <RouterLink to="/signup" class="inline-flex bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold px-7 py-3.5 rounded-xl transition-all shadow-xl shadow-purple-500/30 hover:shadow-purple-500/40 hover:-translate-y-0.5 text-sm">
                ✨ Get Started Free
              </RouterLink>
              <RouterLink to="/login" class="inline-flex bg-white/80 border border-gray-200 hover:border-gray-300 text-gray-700 font-semibold px-7 py-3.5 rounded-xl transition-all hover:-translate-y-0.5 text-sm backdrop-blur-sm">
                🎮 I already have an account
              </RouterLink>
            </div>
            <div class="mt-8 flex flex-wrap items-center gap-6 text-sm text-gray-500">
              <span class="flex items-center gap-1.5">🎓 <span class="font-semibold text-gray-700">100%</span> free for students</span>
              <span class="flex items-center gap-1.5">⚡ <span class="font-semibold text-gray-700">2min</span> setup</span>
              <span class="flex items-center gap-1.5">😎 <span class="font-semibold text-gray-700">no</span> credit card</span>
            </div>
          </div>
          <div class="relative z-10">
            <div class="relative">
              <div class="absolute -inset-4 bg-gradient-to-tr from-purple-200 via-pink-100 to-orange-200 rounded-[32px] blur-2xl opacity-60" />
              <div class="relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/60 overflow-hidden p-1">
                <div class="flex items-center gap-1.5 px-4 py-3 border-b border-gray-100">
                  <div class="w-3 h-3 rounded-full bg-red-400" />
                  <div class="w-3 h-3 rounded-full bg-yellow-400" />
                  <div class="w-3 h-3 rounded-full bg-green-400" />
                  <span class="text-xs text-gray-400 font-medium ml-2">clubflow.app — Dashboard</span>
                </div>
                <div class="p-5 space-y-3">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-xs">JD</div>
                      <div>
                        <div class="text-sm font-semibold">Jamie's Dev Club</div>
                        <div class="text-xs text-gray-400">President</div>
                      </div>
                    </div>
                    <div class="flex gap-1">
                      <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">S</div>
                      <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs font-bold">M</div>
                      <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-xs font-bold">T</div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-2">
                    <div class="bg-purple-50 rounded-xl p-3 text-center">
                      <div class="text-lg font-black text-purple-600">24</div>
                      <div class="text-[10px] text-gray-500 font-semibold uppercase tracking-wide">Members</div>
                    </div>
                    <div class="bg-pink-50 rounded-xl p-3 text-center">
                      <div class="text-lg font-black text-pink-600">3</div>
                      <div class="text-[10px] text-gray-500 font-semibold uppercase tracking-wide">Events</div>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-3 text-center">
                      <div class="text-lg font-black text-orange-600">12</div>
                      <div class="text-[10px] text-gray-500 font-semibold uppercase tracking-wide">Tasks</div>
                    </div>
                  </div>
                  <div class="flex -space-x-2">
                    <div v-for="c in ['bg-purple-400', 'bg-pink-400', 'bg-blue-400', 'bg-green-400', 'bg-orange-400']" :key="c" :class="['w-8 h-8 rounded-full border-2 border-white ' + c]" />
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs text-gray-500 font-bold">+6</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Problems (pain points but funny) -->
    <section class="py-16 lg:py-20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">💀 the struggle is real</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Being in a club should be fun, not a part-time job</h2>
          <p class="text-gray-500 max-w-lg mx-auto">Let's be real — running a student club is chaos. Here's what ClubFlow fixes.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div v-for="(p, i) in problems" :key="i" class="group bg-white/70 backdrop-blur-sm border border-white/60 rounded-2xl p-5 hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="text-3xl mb-3 group-hover:scale-110 transition-transform inline-block">{{ p.emoji }}</div>
            <h3 class="font-bold text-gray-900 mb-1.5">{{ p.title }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ p.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-16 lg:py-20 bg-white/40">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">🚀 what you get</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Everything you need, nothing you don't</h2>
          <p class="text-gray-500 max-w-lg mx-auto">Built by students who got tired of 47 group chats and a spreadsheet that crashes.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div v-for="(f, i) in features" :key="i" class="group bg-white/70 backdrop-blur-sm border border-white/60 rounded-2xl p-5 hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="text-2xl mb-3 group-hover:scale-110 transition-transform inline-block">{{ f.emoji }}</div>
            <h3 class="font-bold text-gray-900 mb-1.5">{{ f.title }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ f.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- How it Works -->
    <section id="how" class="py-16 lg:py-20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">⏱️ literally 2 minutes</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Three steps to club domination</h2>
          <p class="text-gray-500 max-w-lg mx-auto">No tutorials. No onboarding calls. Just click and go.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 relative">
          <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-purple-200 via-pink-200 to-orange-200" />
          <div v-for="(step, i) in steps" :key="i" class="relative text-center">
            <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 text-white text-2xl font-black flex items-center justify-center shadow-xl shadow-purple-500/30 relative z-10">
              {{ step.num }}
            </div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">{{ step.title }}</h3>
            <p class="text-sm text-gray-500 max-w-xs mx-auto">{{ step.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials but fun -->
    <section class="py-16 lg:py-20 bg-white/40">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">🗣️ real humans</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">People are saying things</h2>
          <p class="text-gray-500 max-w-lg mx-auto">(mostly good things, we promise)</p>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
          <div v-for="(t, i) in testimonials" :key="i" class="bg-white/70 backdrop-blur-sm border border-white/60 rounded-2xl p-6 relative">
            <div class="flex gap-0.5 mb-3">
              <span v-for="s in 5" :key="s" class="text-lg">⭐</span>
            </div>
            <p class="text-gray-700 text-sm leading-relaxed mb-5">"{{ t.quote }}"</p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-sm">{{ t.initials }}</div>
              <div>
                <div class="font-semibold text-gray-900 text-sm">{{ t.name }}</div>
                <div class="text-xs text-gray-500">{{ t.role }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="py-16 lg:py-20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">💰 your wallet is safe</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Free. Like, actually free.</h2>
          <p class="text-gray-500 max-w-lg mx-auto">No freemium traps. No "upgrade to unlock members." Just free.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
          <div class="bg-white/70 backdrop-blur-sm border border-white/60 rounded-2xl p-6 text-center">
            <div class="text-4xl mb-2">🎒</div>
            <div class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-1">Student</div>
            <div class="flex items-baseline justify-center gap-1 mb-1">
              <span class="text-5xl font-black text-gray-900">$0</span>
            </div>
            <p class="text-sm text-gray-500 mb-6">Literally everything you need.</p>
            <RouterLink to="/signup" class="w-full inline-flex justify-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 rounded-xl transition-all mb-6 text-sm">
              Start Free 🚀
            </RouterLink>
            <ul class="space-y-2 text-left">
              <li v-for="f in pricingFree" :key="f" class="flex items-center gap-2 text-sm text-gray-600">
                <span>✅</span> {{ f }}
              </li>
            </ul>
          </div>
          <div class="bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 rounded-2xl p-6 text-white text-center relative overflow-hidden">
            <div class="absolute top-3 right-3 bg-white/20 text-xs font-bold px-2.5 py-1 rounded-lg backdrop-blur-sm">✨ BEST VALUE</div>
            <div class="text-4xl mb-2">🌟</div>
            <div class="text-xs font-bold uppercase tracking-[0.2em] text-white/70 mb-1">Campus Pro</div>
            <div class="flex items-baseline justify-center gap-1 mb-1">
              <span class="text-5xl font-black">$0</span>
            </div>
            <p class="text-sm text-white/80 mb-6">Same price, just feels fancier.</p>
            <RouterLink to="/signup" class="w-full inline-flex justify-center bg-white text-purple-700 font-bold py-3 rounded-xl hover:bg-purple-50 transition-all mb-6 text-sm shadow-xl">
              Join Free 🌟
            </RouterLink>
            <ul class="space-y-2 text-left">
              <li v-for="f in pricingPro" :key="f" class="flex items-center gap-2 text-sm text-white/90">
                <span>✨</span> {{ f }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-16 lg:py-20 bg-white/40">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
          <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-gray-400 mb-3">🤔 good questions</div>
          <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Frequently asked (by stressed students)</h2>
        </div>
        <div class="space-y-2">
          <div v-for="(faq, i) in faqs" :key="i" class="bg-white/70 backdrop-blur-sm border border-white/60 rounded-2xl overflow-hidden">
            <button @click="openFaq = openFaq === i ? -1 : i" class="w-full flex items-center justify-between p-5 text-left hover:bg-white/50 transition-colors">
              <span class="font-bold text-gray-900">{{ faq.q }}</span>
              <span class="text-xl ml-4 transition-transform" :class="openFaq === i ? 'rotate-45' : ''">+</span>
            </button>
            <div class="overflow-hidden transition-all duration-300" :style="{ maxHeight: openFaq === i ? '300px' : '0px', opacity: openFaq === i ? 1 : 0 }">
              <div class="px-5 pb-5 text-sm text-gray-600 leading-relaxed">{{ faq.a }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-20 lg:py-24">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 rounded-3xl p-10 lg:p-16 relative overflow-hidden">
          <div class="absolute inset-0 bg-grid-white/10 opacity-10" />
          <div class="relative z-10">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-4">Stop managing clubs the hard way.</h2>
            <p class="text-white/80 text-lg mb-8 max-w-lg mx-auto">Join thousands of student leaders who already ditched the spreadsheets.</p>
            <div class="flex flex-wrap justify-center gap-3">
              <RouterLink to="/signup" class="inline-flex bg-white hover:bg-gray-100 text-purple-700 font-bold px-8 py-3.5 rounded-xl transition-all shadow-2xl hover:-translate-y-0.5 text-sm">
                ✨ Make My Club Awesome
              </RouterLink>
              <RouterLink to="/login" class="inline-flex bg-white/10 hover:bg-white/20 text-white font-semibold px-8 py-3.5 rounded-xl transition-all border border-white/20 text-sm backdrop-blur-sm">
                🎮 I'm already in
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200/60 py-12 bg-white/50">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center shadow-lg">
              <span class="text-white font-black text-sm">CF</span>
            </div>
            <div>
              <span class="font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">ClubFlow</span>
            </div>
          </div>
          <div class="flex gap-6 text-sm text-gray-500">
            <a href="#" class="hover:text-gray-900 transition-colors">Twitter</a>
            <a href="#" class="hover:text-gray-900 transition-colors">GitHub</a>
            <a href="#" class="hover:text-gray-900 transition-colors">Discord</a>
            <a href="#" class="hover:text-gray-900 transition-colors">Instagram</a>
          </div>
        </div>
        <div class="border-t border-gray-200/60 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
          <p class="text-sm text-gray-500">Made with ☕ and 😤 by students who got tired of the chaos.</p>
          <div class="flex gap-4 text-xs text-gray-400">
            <a href="#" class="hover:text-gray-600">Privacy</a>
            <a href="#" class="hover:text-gray-600">Terms</a>
            <a href="#" class="hover:text-gray-600">Cookie Policy</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const openFaq = ref(-1)

const problems = [
  { emoji: '📊', title: 'Spreadsheet Chaos', desc: 'Managing members, dues, and roles in a Google Doc that 12 people are "editing" at once.' },
  { emoji: '📱', title: '47 Group Chats', desc: 'One for announcements, one for planning, one for memes, and you\'re somehow in all of them.' },
  { emoji: '📅', title: 'Nobody Shows Up', desc: 'You planned the event. You promoted it. Three people came. Two left early.' },
  { emoji: '🤷', title: 'Who\'s Doing What?', desc: 'Tasks get assigned in a WhatsApp voice note and everyone assumes someone else will do it.' },
]

const features = [
  { emoji: '👥', title: 'Member Hub', desc: 'See who actually showed up, what they do, and who keeps forgetting to pay dues.' },
  { emoji: '🎉', title: 'Event Wizard', desc: 'Create events, track RSVPs, and stop asking "is anyone coming?" in the group chat.' },
  { emoji: '📢', title: 'Announcements', desc: 'Post once, reaches everyone. No more "did you see my message?"' },
  { emoji: '✅', title: 'Task Manager', desc: 'Assign tasks, set deadlines, and actually know who dropped the ball.' },
  { emoji: '🏆', title: 'Committees', desc: 'Organize teams, assign leads, and pretend you have your life together.' },
  { emoji: '📋', title: 'Attendance', desc: 'Digital check-ins so you can finally prove people actually came to meetings.' },
  { emoji: '📁', title: 'File Sharing', desc: 'One place for all your docs. Goodbye "which drive folder is it in?"' },
  { emoji: '📈', title: 'Analytics', desc: 'Fancy charts that show your club is either thriving or barely hanging on.' },
]

const steps = [
  { num: '1', title: 'Create Your Club', desc: 'Give it a name, add a description, and boom — you\'re a president now.' },
  { num: '2', title: 'Invite the Squad', desc: 'Share a link. Your members join. No import CSVs or Excel drama.' },
  { num: '3', title: 'Run Everything', desc: 'Events, tasks, announcements — all in one place. Go touch grass.' },
]

const testimonials = [
  { quote: 'We went from 12 group chats to one platform. My notifications dropped by 80%. I can actually focus on my degree now.', name: 'Sarah Chen', role: 'President, Tech Society', initials: 'SC' },
  { quote: 'Attendance tracking alone saved our club. We finally know who actually comes to meetings vs who just says they will.', name: 'Marcus J.', role: 'VP, Debate Club', initials: 'MJ' },
  { quote: 'I used to spend 5 hours a week on club admin. Now it\'s maybe 20 minutes. ClubFlow is basically a free assistant.', name: 'Priya K.', role: 'Treasurer, Med Society', initials: 'PK' },
]

const pricingFree = ['Unlimited members', 'Event management', 'Announcements', 'Task tracking', 'Committee management']
const pricingPro = ['Literally everything in Free', 'Analytics dashboard', 'Attendance tracking', 'File sharing', 'Priority "support" (it\'s just us on Discord)']
</script>

<style>
html {
  scroll-behavior: smooth;
}

@keyframes bob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -30px) scale(1.05); }
  66% { transform: translate(-20px, 20px) scale(0.95); }
}

.bg-grid-white\/10 {
  background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
  background-size: 24px 24px;
}
</style>
