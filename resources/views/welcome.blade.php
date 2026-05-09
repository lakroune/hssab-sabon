<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hsab Sabon | Easy Coloc</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* =============================================
               SCROLL ANIMATION BASE STATES
               ============================================= */

            /* Elements hidden before animation */
            [data-animate] {
                opacity: 0;
                transition-property: opacity, transform;
                transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
                transition-duration: 0.75s;
                will-change: opacity, transform;
            }

            /* Fade Up (default) */
            [data-animate="fade-up"] {
                transform: translateY(40px);
            }

            /* Fade Down */
            [data-animate="fade-down"] {
                transform: translateY(-30px);
            }

            /* Fade Left */
            [data-animate="fade-left"] {
                transform: translateX(-40px);
            }

            /* Fade Right */
            [data-animate="fade-right"] {
                transform: translateX(40px);
            }

            /* Scale In */
            [data-animate="scale-in"] {
                transform: scale(0.88);
            }

            /* Blur In */
            [data-animate="blur-in"] {
                transform: translateY(20px);
                filter: blur(8px);
            }

            /* =============================================
               VISIBLE STATE (triggered by JS)
               ============================================= */
            [data-animate].is-visible {
                opacity: 1;
                transform: translateY(0) translateX(0) scale(1);
                filter: blur(0);
            }

            /* Staggered delays for children */
            [data-delay="100"] { transition-delay: 0.1s; }
            [data-delay="200"] { transition-delay: 0.2s; }
            [data-delay="300"] { transition-delay: 0.3s; }
            [data-delay="400"] { transition-delay: 0.4s; }
            [data-delay="500"] { transition-delay: 0.5s; }
            [data-delay="600"] { transition-delay: 0.6s; }
            [data-delay="700"] { transition-delay: 0.7s; }

            /* =============================================
               HERO — page load animation (no scroll needed)
               ============================================= */
            .hero-badge {
                animation: heroFadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
            }
            .hero-title {
                animation: heroFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s both;
            }
            .hero-subtitle {
                animation: heroFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.35s both;
            }
            .hero-cta {
                animation: heroFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.5s both;
            }
            .hero-trust {
                animation: heroFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.65s both;
            }
            .hero-card {
                animation: heroSlideLeft 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
            }

            @keyframes heroFadeUp {
                from { opacity: 0; transform: translateY(30px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            @keyframes heroSlideLeft {
                from { opacity: 0; transform: translateX(50px) scale(0.97); }
                to   { opacity: 1; transform: translateX(0) scale(1); }
            }

            /* =============================================
               NAV SLIDE DOWN
               ============================================= */
            nav {
                animation: navSlide 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
            }
            @keyframes navSlide {
                from { opacity: 0; transform: translateY(-16px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* =============================================
               PING DOT — keep existing Tailwind animate-ping
               ============================================= */

            /* =============================================
               FEATURE CARDS — hover lift (extra polish)
               ============================================= */
            .feature-card {
                transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1),
                            box-shadow 0.3s cubic-bezier(0.22, 1, 0.36, 1),
                            border-color 0.3s ease;
            }
            .feature-card:hover {
                transform: translateY(-6px);
            }

            /* =============================================
               PROGRESS BAR — animated on load
               ============================================= */
            .progress-fill {
                width: 0%;
                animation: progressGrow 1.4s cubic-bezier(0.22, 1, 0.36, 1) 1s forwards;
            }
            @keyframes progressGrow {
                to { width: 75%; }
            }

            /* =============================================
               MOCKUP CARD ITEMS — staggered entrance
               ============================================= */
            .mockup-item-1 {
                animation: mockupItem 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.8s both;
            }
            .mockup-item-2 {
                animation: mockupItem 0.6s cubic-bezier(0.22, 1, 0.36, 1) 1.0s both;
            }
            @keyframes mockupItem {
                from { opacity: 0; transform: translateX(20px); }
                to   { opacity: 1; transform: translateX(0); }
            }

            /* =============================================
               BLOB PULSE (background decoration)
               ============================================= */
            .blob-pulse {
                animation: blobPulse 6s ease-in-out infinite alternate;
            }
            @keyframes blobPulse {
                from { transform: scale(1) translate(0, 0); }
                to   { transform: scale(1.15) translate(-10px, 10px); }
            }

            /* =============================================
               CTA DARK CARD — shimmer effect
               ============================================= */
            .cta-card {
                position: relative;
                overflow: hidden;
            }
            .cta-card::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(
                    105deg,
                    transparent 40%,
                    rgba(251, 191, 36, 0.06) 50%,
                    transparent 60%
                );
                background-size: 200% 100%;
                animation: shimmer 3.5s ease-in-out infinite;
            }
            @keyframes shimmer {
                from { background-position: 200% 0; }
                to   { background-position: -200% 0; }
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] antialiased shadow-2xl overflow-x-hidden">

        <!-- Navigation -->
        <nav class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto border-b border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-amber-400 rounded-lg flex items-center justify-center shadow-sm">
                    <span class="text-white font-bold text-xl">HS</span>
                </div>
                <span class="font-semibold text-lg tracking-tight uppercase">Hsab Sabon</span>
            </div>

            @if (Route::has('login'))
                <div class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-amber-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-amber-600 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-[#1b1b18] text-white rounded-md text-sm font-medium hover:bg-gray-800 transition shadow-sm">Get Started</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto px-6 pt-16 pb-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left Content -->
                <div>
                    <div class="hero-badge inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-xs font-semibold mb-6">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                        Beta Version 1.0
                    </div>

                    <h1 class="hero-title text-5xl lg:text-7xl font-bold leading-tight mb-6">
                        Manage your <span class="text-amber-500 italic">Coloc</span> expenses easily.
                    </h1>

                    <p class="hero-subtitle text-gray-600 text-lg leading-relaxed mb-8 max-w-xl">
                        Keep your shared apartment finances clean like soap. Track debts, split bills, and manage group expenses without the headache.
                    </p>

                    <div class="hero-cta flex flex-col sm:flex-row gap-4 text-center">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-amber-400 text-[#1b1b18] font-bold rounded-xl hover:bg-amber-300 transition shadow-lg shadow-amber-200/50 text-lg">
                            Start Tracking Now
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white border border-gray-200 font-semibold rounded-xl hover:bg-gray-50 transition text-lg">
                            How it works?
                        </a>
                    </div>

                    <!-- Trust Badges -->
                    <div class="hero-trust mt-12 flex items-center gap-6">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-300"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-400"></div>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">Join <span class="text-[#1b1b18] font-bold">+500 Users</span> in Morocco</p>
                    </div>
                </div>

                <!-- Right Content (Visual representation) -->
                <div class="hero-card relative">
                    <div class="blob-pulse absolute -top-10 -right-10 w-64 h-64 bg-amber-100 rounded-full blur-3xl opacity-50"></div>
                    <div class="relative bg-white border border-gray-100 rounded-3xl shadow-2xl p-6 overflow-hidden">
                        <!-- Mockup Header -->
                        <div class="flex justify-between items-end mb-8">
                            <div>
                                <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Total Spent</p>
                                <h3 class="text-3xl font-black">2,450.00 DH</h3>
                            </div>
                            <div class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">
                                +12% this month
                            </div>
                        </div>

                        <!-- Mockup List -->
                        <div class="space-y-4">
                            <div class="mockup-item-1 flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold">🛒</div>
                                    <div>
                                        <p class="font-bold text-sm">Grocery Shopping</p>
                                        <p class="text-xs text-gray-400 font-medium italic">Paid by Abdellah</p>
                                    </div>
                                </div>
                                <span class="font-bold text-sm">-450 DH</span>
                            </div>
                            <div class="mockup-item-2 flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 opacity-60 italic">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">⚡</div>
                                    <div>
                                        <p class="font-bold text-sm italic">Electricity Bill</p>
                                        <p class="text-xs text-gray-400 font-medium">Pending split...</p>
                                    </div>
                                </div>
                                <span class="font-bold text-sm text-amber-600">Pending</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mt-8 pt-6 border-t border-gray-50">
                            <div class="flex justify-between text-xs font-bold mb-2 uppercase tracking-tight">
                                <span>Budget Progress</span>
                                <span>75%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="progress-fill bg-amber-400 h-full rounded-full shadow-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-[#FDFDFC] relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

            <div class="max-w-7xl mx-auto px-6">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-20">
                    <h2
                        data-animate="fade-up"
                        class="text-amber-500 font-bold tracking-widest uppercase text-sm mb-4"
                    >How it works</h2>
                    <p
                        data-animate="fade-up"
                        data-delay="200"
                        class="text-4xl font-black text-[#1b1b18] mb-6"
                    >Keep your "Sabon" clean and your accounts clear.</p>
                    <p
                        data-animate="fade-up"
                        data-delay="400"
                        class="text-gray-500 text-lg"
                    >Everything you need to manage shared living costs without the awkward "Who owes who?" conversations.</p>
                </div>

                <!-- Feature Cards -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div
                        data-animate="fade-up"
                        data-delay="100"
                        class="feature-card group p-8 rounded-3xl bg-white border border-gray-100 hover:border-amber-200 hover:shadow-xl hover:shadow-amber-500/5"
                    >
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            📝
                        </div>
                        <h3 class="text-xl font-bold mb-4">Quick Tracking</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Add expenses in seconds. Whether it's the rent, electricity bill, or just some groceries for the weekend.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div
                        data-animate="fade-up"
                        data-delay="300"
                        class="feature-card group p-8 rounded-3xl bg-white border border-gray-100 hover:border-amber-200 hover:shadow-xl hover:shadow-amber-500/5"
                    >
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            ⚖️
                        </div>
                        <h3 class="text-xl font-bold mb-4">Fair Splitting</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Split bills equally or by custom percentages. Our algorithm calculates exactly who needs to pay what.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div
                        data-animate="fade-up"
                        data-delay="500"
                        class="feature-card group p-8 rounded-3xl bg-white border border-gray-100 hover:border-amber-200 hover:shadow-xl hover:shadow-amber-500/5"
                    >
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            🧼
                        </div>
                        <h3 class="text-xl font-bold mb-4">Clean Slates</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Clear your debts with one click. Keep a history of all settled payments to avoid any future "l-hessaba".
                        </p>
                    </div>
                </div>

                <!-- Dark CTA Card -->
                <div
                    data-animate="scale-in"
                    data-delay="100"
                    class="cta-card mt-20 bg-[#1b1b18] rounded-[2.5rem] p-8 md:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden"
                >
                    <div class="relative z-10">
                        <h3
                            data-animate="fade-left"
                            data-delay="300"
                            class="text-3xl font-bold mb-2"
                        >Ready to clear the air?</h3>
                        <p
                            data-animate="fade-left"
                            data-delay="450"
                            class="text-gray-400"
                        >Stop using messy WhatsApp groups and notebooks.</p>
                    </div>
                    <a
                        data-animate="fade-right"
                        data-delay="400"
                        href="{{ route('register') }}"
                        class="relative z-10 px-8 py-4 bg-white text-[#1b1b18] font-bold rounded-xl hover:bg-amber-400 transition shadow-lg shrink-0"
                    >
                        Create My Group
                    </a>
                    <!-- Decor circles -->
                    <div class="blob-pulse absolute top-0 right-0 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer
            data-animate="fade-up"
            class="border-t border-gray-100 py-12 bg-white"
        >
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6 text-gray-500 text-sm">
                <p>&copy; 2026 HSAB SABON. All rights reserved by Ismail Lakroune.</p>
                <div class="flex gap-8 font-medium">
                    <a href="#" class="hover:text-[#1b1b18] transition">Features</a>
                    <a href="#" class="hover:text-[#1b1b18] transition">Contact</a>
                    <a href="#" class="hover:text-[#1b1b18] transition">Privacy</a>
                </div>
            </div>
        </footer>

        <!-- =============================================
             SCROLL ANIMATION SCRIPT
             ============================================= -->
        <script>
            (function () {
                'use strict';

                // All elements tagged with [data-animate]
                const targets = document.querySelectorAll('[data-animate]');

                if (!targets.length) return;

                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                                // Unobserve after trigger → animation runs once
                                observer.unobserve(entry.target);
                            }
                        });
                    },
                    {
                        threshold: 0.12,       // trigger when 12% of element is visible
                        rootMargin: '0px 0px -40px 0px', // a little early
                    }
                );

                targets.forEach((el) => observer.observe(el));
            })();
        </script>

    </body>
</html>