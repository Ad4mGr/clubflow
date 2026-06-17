<template>
    <div class="page-bg text-slate-900 relative overflow-hidden">
        <div class="campus-grid" aria-hidden="true"></div>
        <nav class="sticky top-0 z-50 bg-white/80 border-b border-white/60 backdrop-blur-md shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center shadow-lg shadow-accent-600/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div class="leading-tight">
                            <span class="text-lg font-semibold text-slate-900">ClubFlow</span>
                            <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Campus Suite</div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Features</a>
                        <a href="#showcase" class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Product</a>
                        <a href="#pricing" class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Pricing</a>
                        <a href="#faq" class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">FAQ</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <RouterLink
                            to="/login"
                            class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors"
                        >
                            Sign In
                        </RouterLink>
                        <RouterLink
                            to="/signup"
                            class="inline-flex bg-accent-600 hover:bg-accent-700 text-slate text-sm font-semibold px-4 py-2 rounded-lg transition-colors shadow-md shadow-accent-600/30"
                        >
                            Get Started
                        </RouterLink>
                    </div>
                </div>
            </div>
        </nav>

        <section class="py-20 lg:py-32 overflow-hidden relative">
            <div class="hero-sheen" aria-hidden="true"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="fade-in">
                        <div class="inline-flex items-center gap-2 bg-white/80 border border-white/60 text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-full mb-6 shadow-sm">
                            <span class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></span>
                            University-grade club operations
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl display-font tracking-tight text-slate-900 leading-[1.05] mb-6">
                            Run your campus clubs like a modern institution
                        </h1>
                        <p class="text-lg text-slate-600 leading-relaxed mb-8 max-w-xl">
                            ClubFlow brings councils, societies, and departments into one secure hub for membership, events, finances, and campus-wide reporting.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <RouterLink
                                to="/signup"
                                class="inline-flex bg-accent-600 hover:bg-accent-700 text-slate font-semibold px-6 py-3 rounded-lg transition-all shadow-lg shadow-accent-600/30 hover:-translate-y-0.5"
                            >
                                Launch Campus Pilot
                            </RouterLink>
                            <RouterLink
                                to="/login"
                                class="inline-flex bg-white/90 border border-white/70 hover:border-white text-slate-700 font-semibold px-6 py-3 rounded-lg transition-all hover:-translate-y-0.5"
                            >
                                Request Institutional Demo
                            </RouterLink>
                        </div>
                        <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4 max-w-xl">
                            <div class="stat-chip">
                                <div class="text-lg font-semibold text-slate-900">24h</div>
                                <div class="text-xs text-slate-500">Campus onboarding</div>
                            </div>
                            <div class="stat-chip">
                                <div class="text-lg font-semibold text-slate-900">500+</div>
                                <div class="text-xs text-slate-500">Verified clubs</div>
                            </div>
                            <div class="stat-chip">
                                <div class="text-lg font-semibold text-slate-900">SOC 2</div>
                                <div class="text-xs text-slate-500">Security ready</div>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 mt-4">No credit card required and free for student clubs</p>
                    </div>
                    <div class="fade-in relative">
                        <div class="absolute -inset-6 bg-gradient-to-tr from-amber-100 via-accent-100 to-slate-200 rounded-[36px] blur-2xl opacity-60"></div>
                        <div class="relative glass-panel rounded-2xl shadow-2xl border border-white/60 overflow-hidden">
                            <div class="absolute top-4 right-4 campus-badge">Campus control</div>
                            <img src="https://image.qwenlm.ai/public_source/060962b7-3cd7-4b4c-867c-77d68da25ae5/1cb171871-a295-480b-b519-3fc02a351c99.png" alt="Dashboard Mockup" class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 border-y border-white/60 bg-white/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-xs font-semibold uppercase tracking-[0.3em] text-slate-500 mb-8">Trusted by leading universities and clubs</p>
                <div class="flex flex-wrap justify-center items-center gap-8 sm:gap-12">
                    <div v-for="logo in trustedLogos" :key="logo.name" class="flex items-center gap-3 text-slate-400">
                        <svg class="w-8 h-8" viewBox="0 0 32 32" fill="currentColor"><path d="M16 2L2 8l14 6 14-6-14-6zM2 16l14 6 14-6M2 24l14 6 14-6"/></svg>
                        <span class="text-lg font-semibold tracking-tight">{{ logo.name }}</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <div class="section-kicker">Campus challenges</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Campus leadership should not feel like a second degree</h2>
                    <p class="text-lg text-slate-600">Student leaders lose weeks every semester to spreadsheets and scattered channels.</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="(problem, idx) in problems" :key="idx" class="campus-card group">
                        <div class="w-12 h-12 bg-rose-50 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="problem.icon"/></svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">{{ problem.title }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ problem.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-20 lg:py-28 bg-white/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <div class="section-kicker">Platform</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Built for the way universities actually operate</h2>
                    <p class="text-lg text-slate-600">A unified toolkit designed for councils, societies, and campus leadership teams.</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="(feature, idx) in features" :key="idx" class="campus-card campus-card--soft group">
                        <div class="w-10 h-10 bg-accent-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-accent-100 transition-colors">
                            <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="feature.icon"/></svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">{{ feature.title }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ feature.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="showcase" class="py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <div class="section-kicker">Product</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">One dashboard for the entire campus</h2>
                    <p class="text-lg text-slate-600">Designed for councils, advisors, and student leaders who need clarity fast.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-2 mb-8">
                    <button v-for="tab in tabs" :key="tab" @click="activeTab = tab" :class="['px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-[0.15em] transition-all', activeTab === tab ? 'bg-accent-600 text-white shadow-md shadow-accent-600/30' : 'bg-white/80 text-slate-500 hover:text-slate-900 hover:bg-white']">
                        {{ tab }}
                    </button>
                </div>
                <div class="relative glass-panel rounded-2xl shadow-2xl border border-white/60 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-8 bg-gray-50 border-b border-gray-100 flex items-center px-4 gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <img :src="activeTab === 'Analytics' ? showcaseImg2 : showcaseImg1" :alt="activeTab" class="w-full h-auto pt-8">
                </div>
            </div>
        </section>

        <section class="py-20 lg:py-28 bg-white/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <div class="section-kicker">How it works</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Launch a campus program in minutes</h2>
                </div>
                <div class="grid md:grid-cols-3 gap-8 relative">
                    <div class="hidden md:block absolute top-12 left-1/4 right-1/4 h-0.5 bg-gradient-to-r from-transparent via-slate-300 to-transparent"></div>
                    <div v-for="(step, idx) in steps" :key="idx" class="relative text-center">
                        <div class="w-12 h-12 bg-accent-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-lg font-bold shadow-lg shadow-accent-600/40 relative z-10">{{ idx + 1 }}</div>
                        <h3 class="font-semibold text-slate-900 text-lg mb-2">{{ step.title }}</h3>
                        <p class="text-sm text-slate-600 max-w-xs mx-auto">{{ step.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="section-kicker">Outcomes</div>
                        <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-6">Measurable impact across campus</h2>
                        <p class="text-lg text-slate-600 mb-8">Give advisors and leaders clear insight into engagement, attendance, and growth.</p>
                        <div class="space-y-4">
                            <div v-for="(benefit, idx) in benefits" :key="idx" class="flex items-start gap-4">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900">{{ benefit.title }}</h4>
                                    <p class="text-sm text-slate-600">{{ benefit.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="stat-card">
                            <div class="text-3xl font-semibold text-slate-900 mb-1">10h+</div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Saved weekly</div>
                        </div>
                        <div class="stat-card">
                            <div class="text-3xl font-semibold text-slate-900 mb-1">3x</div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Engagement</div>
                        </div>
                        <div class="stat-card">
                            <div class="text-3xl font-semibold text-slate-900 mb-1">95%</div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Attendance</div>
                        </div>
                        <div class="stat-card">
                            <div class="text-3xl font-semibold text-slate-900 mb-1">500+</div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Active clubs</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 lg:py-28 bg-white/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <div class="section-kicker">Testimonials</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Trusted by campus leaders</h2>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div v-for="(t, idx) in testimonials" :key="idx" class="campus-card campus-card--quote">
                        <div class="flex gap-1 mb-4">
                            <svg v-for="i in 5" :key="i" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-slate-700 text-sm leading-relaxed mb-6">"{{ t.quote }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-accent-100 rounded-full flex items-center justify-center text-accent-700 font-semibold text-sm">{{ t.initials }}</div>
                            <div>
                                <div class="font-medium text-slate-900 text-sm">{{ t.name }}</div>
                                <div class="text-xs text-slate-500">{{ t.role }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <div class="section-kicker">Pricing</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Transparent pricing for every campus</h2>
                    <p class="text-lg text-slate-600">Start free, then scale to institutional reporting and controls.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <div class="campus-card campus-card--soft">
                        <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Free plan</div>
                        <div class="flex items-baseline gap-1 mb-4">
                            <span class="text-4xl font-semibold text-slate-900">$0</span>
                            <span class="text-slate-500">/month</span>
                        </div>
                        <p class="text-sm text-slate-600 mb-6">Perfect for small clubs just getting started.</p>
                        <RouterLink
                            to="/signup"
                            class="w-full inline-flex justify-center bg-slate-100 hover:bg-slate-200 text-slate-900 font-semibold py-2.5 rounded-lg transition-colors mb-8"
                        >
                            Get Started
                        </RouterLink>
                        <ul class="space-y-3">
                            <li v-for="f in pricingFree" :key="f" class="flex items-center gap-3 text-sm text-slate-700">
                                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                {{ f }}
                            </li>
                        </ul>
                    </div>
                    <div class="campus-card campus-card--pro">
                        <div class="absolute top-4 right-4 bg-white/20 text-xs font-semibold px-2 py-1 rounded">POPULAR</div>
                        <div class="text-xs font-semibold uppercase tracking-[0.2em] text-accent-200 mb-2">Pro plan</div>
                        <div class="flex items-baseline gap-1 mb-4">
                            <span class="text-4xl font-bold">$12</span>
                            <span class="text-accent-200">/month</span>
                        </div>
                        <p class="text-sm text-accent-100 mb-6">For growing clubs that need advanced tools.</p>
                        <RouterLink
                            to="/signup"
                            class="w-full inline-flex justify-center bg-white text-accent-700 font-semibold py-2.5 rounded-lg hover:bg-accent-50 transition-colors mb-8"
                        >
                            Start Free Trial
                        </RouterLink>
                        <ul class="space-y-3">
                            <li v-for="f in pricingPro" :key="f" class="flex items-center gap-3 text-sm text-white">
                                <svg class="w-4 h-4 text-accent-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                {{ f }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="py-20 lg:py-28 bg-white/60">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="section-kicker">FAQ</div>
                    <h2 class="text-3xl sm:text-4xl display-font text-slate-900 mb-4">Frequently asked questions</h2>
                </div>
                <div class="space-y-3">
                    <div v-for="(faq, idx) in faqs" :key="idx" class="campus-card campus-card--soft overflow-hidden">
                        <button @click="openFaq = openFaq === idx ? -1 : idx" class="w-full flex items-center justify-between p-5 text-left hover:bg-white/80 transition-colors">
                            <span class="font-medium text-slate-900">{{ faq.q }}</span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform flex-shrink-0 ml-4" :class="{'rotate-180': openFaq === idx}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="overflow-hidden transition-all duration-300" :style="{ maxHeight: openFaq === idx ? '200px' : '0px', opacity: openFaq === idx ? 1 : 0 }">
                            <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">{{ faq.a }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 lg:py-28">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl display-font text-slate-900 mb-6">Everything your university clubs need to stay aligned</h2>
                <p class="text-lg text-slate-600 mb-8 max-w-xl mx-auto">Launch a campus-wide standard in days, not semesters.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <RouterLink
                        to="/signup"
                        class="inline-flex bg-accent-600 hover:bg-accent-700 text-slate font-semibold px-8 py-3.5 rounded-lg transition-all shadow-lg shadow-accent-600/30 hover:-translate-y-0.5"
                    >
                        Start Campus Pilot
                    </RouterLink>
                    <RouterLink
                        to="/login"
                        class="inline-flex bg-white/90 border border-white/70 hover:border-white text-slate-700 font-semibold px-8 py-3.5 rounded-lg transition-all hover:-translate-y-0.5"
                    >
                        Request Institutional Demo
                    </RouterLink>
                </div>
            </div>
        </section>

        <footer class="border-t border-white/60 py-12 bg-white/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center shadow-lg shadow-accent-600/30">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <span class="text-lg font-semibold text-slate-900">CampusClub Hub</span>
                        </div>
                        <p class="text-sm text-slate-600">The modern platform for university club management.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm">Product</h4>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li><a href="#" class="hover:text-slate-900">Features</a></li>
                            <li><a href="#" class="hover:text-slate-900">Pricing</a></li>
                            <li><a href="#" class="hover:text-slate-900">Integrations</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm">Company</h4>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li><a href="#" class="hover:text-slate-900">About</a></li>
                            <li><a href="#" class="hover:text-slate-900">Blog</a></li>
                            <li><a href="#" class="hover:text-slate-900">Careers</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm">Support</h4>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li><a href="#" class="hover:text-slate-900">Help Center</a></li>
                            <li><a href="#" class="hover:text-slate-900">Contact</a></li>
                            <li><a href="#" class="hover:text-slate-900">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-slate-500">© 2024 CampusClub Hub. All rights reserved.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>
            </div>
        </footer>
        
    </div>
</template>

<script setup>
import { ref } from 'vue';

const activeTab = ref('Dashboard');
const openFaq = ref(-1);

const trustedLogos = [
    { name: 'Stanford' },
    { name: 'MIT' },
    { name: 'Berkeley' },
    { name: 'Harvard' },
    { name: 'Princeton' },
    { name: 'Yale' },
];

const problems = [
    { title: 'Spreadsheet Chaos', desc: 'Managing member lists, dues, and roles in endless spreadsheets that nobody can find.', icon: 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
    { title: 'Lost Events', desc: 'Events buried in group chats. Members miss important meetings and deadlines.', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { title: 'Poor Communication', desc: 'Important announcements get lost in WhatsApp groups and email threads.', icon: 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z' },
    { title: 'Task Confusion', desc: 'No clear ownership of tasks. Committee members unsure of their responsibilities.', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' },
];

const features = [
    { title: 'Member Management', desc: 'Track members, roles, and committee assignments in one place.', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
    { title: 'Event Planning', desc: 'Create, promote, and track RSVPs for all club events.', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { title: 'Announcements', desc: 'Push important news to all members instantly via feed and email.', icon: 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z' },
    { title: 'Committee Management', desc: 'Organize committees, assign leaders, and track responsibilities.', icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4' },
    { title: 'Task Tracking', desc: 'Assign tasks, set deadlines, and monitor progress effortlessly.', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' },
    { title: 'Attendance Tracking', desc: 'Digital check-ins for meetings and events with instant reports.', icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' },
    { title: 'Document Sharing', desc: 'Centralized repository for club documents, forms, and resources.', icon: 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z' },
    { title: 'Analytics Dashboard', desc: 'Insights on member engagement, event attendance, and growth.', icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z' },
];

const tabs = ['Dashboard', 'Events', 'Members', 'Announcements', 'Analytics'];
const showcaseImg1 = 'https://image.qwenlm.ai/public_source/060962b7-3cd7-4b4c-867c-77d68da25ae5/1cb171871-a295-480b-b519-3fc02a351c99.png';
const showcaseImg2 = 'https://image.qwenlm.ai/public_source/060962b7-3cd7-4b4c-867c-77d68da25ae5/1837b3cb2-4f7d-4d52-9c37-383fd29bee93.png';

const steps = [
    { title: 'Create Your Club', desc: 'Set up your club profile, define committees, and customize your workspace in minutes.' },
    { title: 'Invite Members', desc: 'Share a link or import your member list. Everyone gets instant access to the platform.' },
    { title: 'Manage Everything', desc: 'Plan events, assign tasks, track attendance, and communicate - all from one place.' },
];

const benefits = [
    { title: 'Save Administrative Time', desc: 'Automate repetitive tasks and reduce manual work by up to 80%.' },
    { title: 'Increase Member Engagement', desc: 'Keep members informed and involved with timely updates and easy RSVPs.' },
    { title: 'Better Event Organization', desc: 'Plan, promote, and execute events with clear ownership and tracking.' },
    { title: 'Improve Communication', desc: 'Replace scattered group chats with structured, searchable announcements.' },
    { title: 'Grow Club Participation', desc: 'Data-driven insights help you understand and grow your membership.' },
];

const testimonials = [
    { quote: 'CampusClub Hub completely transformed how we run our engineering society. We went from chaotic WhatsApp groups to organized, efficient operations.', name: 'Sarah Chen', role: 'President, Tech Society', initials: 'SC' },
    { quote: 'The attendance tracking alone saves us hours every week. Our committee finally knows who is coming to events before they happen.', name: 'Marcus Johnson', role: 'VP Operations, Debate Club', initials: 'MJ' },
    { quote: 'As a university administrator, I love that all clubs use one platform. It makes reporting and oversight so much simpler.', name: 'Dr. Emily Roberts', role: 'Student Affairs Director', initials: 'ER' },
];

const pricingFree = ['Up to 50 members', 'Basic event management', 'Announcements and news feed', 'Task assignment', 'Community support'];
const pricingPro = ['Unlimited members', 'Advanced analytics dashboard', 'Priority support', 'Custom branding', 'Document sharing and storage', 'Attendance tracking and reports'];

const faqs = [
    { q: 'Is it free for students?', a: 'Yes! Our Free Plan is completely free for student clubs with up to 50 members. It includes all the essential features you need to get started.' },
    { q: 'Can multiple committee members manage a club?', a: 'Absolutely. You can assign different roles and permissions to committee members, so everyone can contribute without stepping on each other\'s toes.' },
    { q: 'Can we track attendance?', a: 'Yes! The Pro Plan includes digital attendance tracking for meetings and events, with instant reports and exportable data.' },
    { q: 'Can universities manage multiple clubs?', a: 'Yes, we offer university-wide plans that allow administrators to oversee all clubs, generate reports, and ensure compliance with university policies.' },
];
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap');

:global(html) {
    scroll-behavior: smooth;
}

:global(body) {
    font-family: 'Manrope', sans-serif;
    background-color: #f8f5ef;
    color: #0b1f3a;
}

.display-font {
    font-family: 'Playfair Display', serif;
    letter-spacing: -0.01em;
}

.page-bg {
    background: linear-gradient(180deg, #f8f5ef 0%, #f1ece3 45%, #f8f5ef 100%);
}

.campus-grid {
    position: absolute;
    inset: 0;
    background-image: linear-gradient(rgba(11, 31, 58, 0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(11, 31, 58, 0.06) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
    opacity: 0.4;
}

.hero-sheen {
    position: absolute;
    inset: -20% 0 0;
    background: radial-gradient(circle at 20% 20%, rgba(202, 166, 74, 0.25), transparent 60%),
        radial-gradient(circle at 80% 10%, rgba(11, 31, 58, 0.2), transparent 55%);
    pointer-events: none;
}

.glass-panel {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(18px);
}

.section-kicker {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.3em;
    font-size: 0.65rem;
    font-weight: 600;
    color: rgba(27, 42, 65, 0.6);
    margin-bottom: 0.75rem;
}

.campus-card {
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(231, 220, 200, 0.9);
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 16px 40px -30px rgba(11, 31, 58, 0.35);
}

.campus-card--soft {
    background: rgba(255, 255, 255, 0.75);
}

.campus-card--quote {
    background: rgba(255, 255, 255, 0.9);
}

.campus-card--pro {
    background: linear-gradient(150deg, #203354 0%, #0b1f3a 60%, #0b1f3a 100%);
    border: 1px solid rgba(202, 166, 74, 0.35);
    color: #ffffff;
    border-radius: 1.25rem;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 30px 60px -40px rgba(11, 31, 58, 0.7);
}

.stat-chip {
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(231, 220, 200, 0.9);
    border-radius: 0.9rem;
    padding: 0.9rem 1rem;
    box-shadow: 0 12px 30px -24px rgba(11, 31, 58, 0.45);
}

.stat-card {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(231, 220, 200, 0.9);
    border-radius: 1.25rem;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 16px 40px -32px rgba(11, 31, 58, 0.45);
}

.campus-badge {
    background: rgba(11, 31, 58, 0.9);
    color: #f8f5ef;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.25em;
    padding: 0.4rem 0.8rem;
    border-radius: 999px;
    border: 1px solid rgba(202, 166, 74, 0.5);
}

.fade-in {
    animation: fadeIn 0.7s ease-out forwards;
}

.float-slow {
    animation: float 14s ease-in-out infinite;
}

.float-slower {
    animation: float 18s ease-in-out infinite;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-12px);
    }
    100% {
        transform: translateY(0px);
    }
}
</style>

