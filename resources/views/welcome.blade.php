<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hsab Sabon | Easy Coloc</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i"
        rel="stylesheet" />
    {{-- cdn tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --amber: #F5A623;
            --amber-light: #FBBF47;
            --dark: #1b1b18;
            --cream: #FDFDFC;
            --sand: #F7F3ED;
        }

        /* --- LOADING SCREEN --- */
        #loading-screen {
            position: fixed;
            inset: 0;
            background: #1b1b18;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #loading-screen.hide {
            opacity: 0;
            transform: scale(1.05);
            pointer-events: none;
        }

        /* moroccan mosaic background tiles */
        .loader-bg {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(245, 166, 35, 0.04) 0px, rgba(245, 166, 35, 0.04) 1px, transparent 1px, transparent 40px),
                repeating-linear-gradient(-45deg, rgba(245, 166, 35, 0.04) 0px, rgba(245, 166, 35, 0.04) 1px, transparent 1px, transparent 40px);
            animation: shimmerBg 4s linear infinite;
        }

        @keyframes shimmerBg {
            0% {
                background-position: 0 0, 0 0;
            }

            100% {
                background-position: 80px 80px, -80px 80px;
            }
        }

        /* Dirham coin spinner */
        .coin-wrapper {
            position: relative;
            width: 90px;
            height: 90px;
        }

        .coin-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 3px solid transparent;
            animation: spinRing 1.4s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        }

        .coin-ring-1 {
            border-top-color: #F5A623;
            border-right-color: #F5A623;
            animation-duration: 1.4s;
        }

        .coin-ring-2 {
            border-bottom-color: rgba(245, 166, 35, 0.4);
            border-left-color: rgba(245, 166, 35, 0.4);
            animation-duration: 1.8s;
            animation-direction: reverse;
            inset: 8px;
        }

        .coin-ring-3 {
            border-top-color: rgba(245, 166, 35, 0.15);
            animation-duration: 2.4s;
            inset: 16px;
        }

        @keyframes spinRing {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .coin-center {
            position: absolute;
            inset: 20px;
            background: radial-gradient(circle at 35% 35%, #FBBF47, #D48A10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(245, 166, 35, 0.5), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            animation: coinPulse 1.4s ease-in-out infinite;
        }

        @keyframes coinPulse {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(245, 166, 35, 0.4), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(245, 166, 35, 0.8), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
        }

        .coin-symbol {
            color: #fff;
            font-size: 18px;
            font-weight: 900;
            font-family: 'Instrument Sans', sans-serif;
            letter-spacing: -0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* progress bar */
        .loader-progress {
            width: 160px;
            height: 2px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 99px;
            overflow: hidden;
            margin-top: 28px;
        }

        .loader-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #F5A623, #FBBF47);
            border-radius: 99px;
            animation: progressFill 2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes progressFill {
            0% {
                width: 0%;
            }

            60% {
                width: 75%;
            }

            100% {
                width: 100%;
            }
        }

        .loader-tagline {
            color: rgba(255, 255, 255, 0.3);
            font-size: 10px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            margin-top: 14px;
            font-family: 'Instrument Sans', sans-serif;
            animation: blink 1.6s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.8;
            }
        }

        /* --- PAGE ANIMATIONS --- */
        /* --- SCROLL REVEAL ANIMATIONS (Up & Down) --- */
        [data-reveal] {
            opacity: 0;
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }

        /* Default: reveal from bottom (scroll down) */
        [data-reveal]:not([data-reveal-dir]) {
            transform: translateY(40px);
        }

        /* Reveal from top (scroll up) */
        [data-reveal][data-reveal-dir="up"] {
            transform: translateY(-40px);
        }

        /* Reveal from left */
        [data-reveal][data-reveal-dir="left"] {
            transform: translateX(-40px);
        }

        /* Reveal from right */
        [data-reveal][data-reveal-dir="right"] {
            transform: translateX(40px);
        }

        /* Scale reveal */
        [data-reveal][data-reveal-dir="scale"] {
            transform: scale(0.85);
        }

        /* Rotate reveal */
        [data-reveal][data-reveal-dir="rotate"] {
            transform: rotate(-3deg) translateY(30px);
        }

        /* Visible state */
        [data-reveal].visible {
            opacity: 1;
            transform: translateY(0) translateX(0) scale(1) rotate(0deg);
        }

        /* Stagger delays */
        [data-reveal-delay="0.1s"] {
            transition-delay: 0.1s;
        }

        [data-reveal-delay="0.15s"] {
            transition-delay: 0.15s;
        }

        [data-reveal-delay="0.2s"] {
            transition-delay: 0.2s;
        }

        [data-reveal-delay="0.3s"] {
            transition-delay: 0.3s;
        }

        [data-reveal-delay="0.4s"] {
            transition-delay: 0.4s;
        }

        [data-reveal-delay="0.5s"] {
            transition-delay: 0.5s;
        }

        [data-reveal-delay="0.6s"] {
            transition-delay: 0.6s;
        }

        [data-reveal-delay="0.8s"] {
            transition-delay: 0.8s;
        }

        /* --- HERO --- */
        .hero-section {
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 80% 20%, rgba(245, 166, 35, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 10% 80%, rgba(245, 166, 35, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }

        /* --- STATS STRIP --- */
        .stats-strip {
            background: var(--dark);
            padding: 28px 0;
            overflow: hidden;
        }

        .stats-ticker {
            display: flex;
            gap: 80px;
            animation: ticker 18s linear infinite;
            width: max-content;
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
        }

        .stat-dot {
            width: 6px;
            height: 6px;
            background: var(--amber);
            border-radius: 50%;
        }

        /* --- HOW IT WORKS --- */
        .step-number {
            font-size: 72px;
            font-weight: 900;
            line-height: 1;
            color: transparent;
            -webkit-text-stroke: 1.5px rgba(245, 166, 35, 0.25);
            font-family: 'Playfair Display', serif;
        }

        /* --- TESTIMONIALS --- */
        .testimonials-section {
            background: var(--sand);
            position: relative;
            overflow: hidden;
        }

        .testimonials-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(245, 166, 35, 0.4), transparent);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .avatar-ring {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
        }

        .quote-mark {
            font-family: 'Playfair Display', serif;
            font-size: 60px;
            line-height: 0.6;
            color: rgba(245, 166, 35, 0.2);
            font-style: italic;
        }

        /* --- DIRHAM VISUAL --- */
        .dirham-float {
            animation: floatCoin 3s ease-in-out infinite;
        }

        .dirham-float:nth-child(2) {
            animation-delay: 0.5s;
        }

        .dirham-float:nth-child(3) {
            animation-delay: 1s;
        }

        @keyframes floatCoin {

            0%,
            100% {
                transform: translateY(0) rotate(-2deg);
            }

            50% {
                transform: translateY(-12px) rotate(2deg);
            }
        }

        /* --- FEATURES --- */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        /* --- CTA --- */
        .cta-section {
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(245, 166, 35, 0.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 50%, rgba(245, 166, 35, 0.08) 0%, transparent 60%);
        }

        .moroccan-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.03;
            background-image:
                repeating-linear-gradient(60deg, #F5A623 0, #F5A623 1px, transparent 1px, transparent 50%),
                repeating-linear-gradient(-60deg, #F5A623 0, #F5A623 1px, transparent 1px, transparent 50%),
                repeating-linear-gradient(0deg, #F5A623 0, #F5A623 1px, transparent 1px, transparent 50%);
            background-size: 40px 40px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: var(--amber);
            color: var(--dark);
            font-weight: 700;
            border-radius: 14px;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 8px 30px rgba(245, 166, 35, 0.35);
        }

        .btn-primary:hover {
            background: var(--amber-light);
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(245, 166, 35, 0.45);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: transparent;
            color: white;
            font-weight: 600;
            border-radius: 14px;
            font-size: 16px;
            text-decoration: none;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.05);
        }

        /* nav scroll effect */
        nav {
            transition: background 0.3s, box-shadow 0.3s, backdrop-filter 0.3s, transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        }

        nav.scrolled {
            background: rgba(253, 253, 252, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 24px rgba(0, 0, 0, 0.06);
        }

        /* --- DASHBOARD MOCKUP --- */
        .mockup-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .mockup-bar {
            height: 8px;
            border-radius: 4px;
            background: #f0f0f0;
            overflow: hidden;
        }

        .mockup-bar-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, var(--amber), var(--amber-light));
        }
    </style>
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] antialiased" style="font-family:'Instrument Sans',sans-serif;">

    <!-- =========== LOADING SCREEN =========== -->
    <div id="loading-screen">
        <div class="loader-bg"></div>

        <div class="relative z-10 flex flex-col items-center">
            <!-- Coin Spinner -->
            <div class="coin-wrapper">
                <div class="coin-ring coin-ring-1"></div>
                <div class="coin-ring coin-ring-2"></div>
                <div class="coin-ring coin-ring-3"></div>
                <div class="coin-center">
                    <span class="coin-symbol">HS</span>
                </div>
            </div>

            <!-- Brand name -->
            <p
                style="color:white;font-size:18px;font-weight:700;letter-spacing:0.15em;margin-top:20px;text-transform:uppercase;">
                Hsab Sabon
            </p>
            <p style="color:rgba(255,255,255,0.35);font-size:11px;letter-spacing:0.25em;margin-top:4px;">
                COLOC FINANCES · MAROC
            </p>

            <!-- Progress bar -->
            <div class="loader-progress">
                <div class="loader-progress-fill" id="progressBar"></div>
            </div>

            <p class="loader-tagline">Loading your finances...</p>
        </div>
    </div>

    <!-- =========== NAVBAR =========== -->
    <nav id="navbar"
        class="fixed top-0 left-0 right-0 z-40 flex items-center justify-between px-6 py-4 max-w-7xl mx-auto"
        style="max-width:100%; z-index:100; transition: all 0.3s ease; position:fixed;">
        <div class="max-w-7xl w-full mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:var(--amber);">
                    <span style="color:white;font-weight:700;font-size:13px;">HS</span>
                </div>
                <span style="font-weight:700;font-size:16px;letter-spacing:-0.02em;">Hsab Sabon</span>
            </div>
            @if (Route::has('login'))
                <div class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium" style="color:#555;">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary"
                                style="padding:10px 22px;font-size:14px;border-radius:10px;">
                                Commencer <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- =========== HERO =========== -->
    <section class="hero-section min-h-screen flex items-center pt-20">
        <div class="hero-pattern"></div>
        <div class="max-w-7xl mx-auto px-6 py-20 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Left: Copy -->
                <div data-reveal data-reveal-dir="left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full mb-8"
                        style="background:#FEF3C7;border:1px solid #FDE68A;">
                        <span
                            style="width:6px;height:6px;background:#F59E0B;border-radius:50%;display:inline-block;"></span>
                        <span style="color:#92400E;font-size:11px;font-weight:700;letter-spacing:0.1em;">BETA 1.0
                        </span>
                    </div>

                    <h1
                        style="font-family:'Playfair Display',serif;font-size:clamp(48px,6vw,78px);font-weight:900;line-height:1.05;margin-bottom:24px;">
                        Coloc sans<br>
                        <span style="color:var(--amber);font-style:italic;">galère</span><br>
                        <span
                            style="font-size:0.75em;font-weight:700;font-family:'Instrument Sans',sans-serif;color:#888;">d'argent.</span>
                    </h1>

                    <p style="color:#666;font-size:18px;line-height:1.7;margin-bottom:32px;max-width:480px;">
                        Fini les disputes avec tes <em>colocs</em>. Trackez vos dépenses,
                        partagez les factures, et réglez vos dettes facilement — en <strong>dirhams</strong>.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register') }}" class="btn-primary">
                            Commencer gratuitement <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#features"
                            style="display:inline-flex;align-items:center;gap:8px;padding:16px 28px;color:#555;font-weight:600;font-size:15px;text-decoration:none;transition:color 0.2s;">
                            Voir comment ça marche <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down">
                                <path d="M12 5v14" />
                                <path d="m19 12-7 7-7-7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Social proof -->
                    <div class="flex items-center gap-4 mt-10">
                        <div class="flex -space-x-2">
                            <div
                                style="width:32px;height:32px;border-radius:50%;background:#F59E0B;border:2px solid white;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;">
                                Y</div>
                            <div
                                style="width:32px;height:32px;border-radius:50%;background:#3B82F6;border:2px solid white;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;">
                                A</div>
                            <div
                                style="width:32px;height:32px;border-radius:50%;background:#10B981;border:2px solid white;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;">
                                K</div>
                            <div
                                style="width:32px;height:32px;border-radius:50%;background:#EF4444;border:2px solid white;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;">
                                S</div>
                        </div>
                        <p style="color:#888;font-size:13px;">
                            <strong style="color:#1b1b18;">+120 colocs</strong> utilisent Hsab Sabon
                        </p>
                    </div>
                </div>

                <!-- Right: Dashboard Mockup -->
                <div data-reveal data-reveal-dir="right" data-reveal-delay="0.15s">
                    <div style="position:relative;">
                        <!-- Glow blob -->
                        <div
                            style="position:absolute;top:-40px;right:-40px;width:280px;height:280px;background:radial-gradient(circle,rgba(245,166,35,0.15),transparent 70%);border-radius:50%;pointer-events:none;">
                        </div>

                        <!-- Floating coins -->
                        <div class="dirham-float" style="position:absolute;top:-20px;left:10%;z-index:10;">
                            {{-- <div
                                style="background:linear-gradient(135deg,#FBBF47,#D48A10);width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:900;color:white;box-shadow:0 8px 20px rgba(245,166,35,0.4);">
                                <span style="font-family:'Instrument Sans';">HS</span>
                            </div> --}}
                        </div>
                        <div class="dirham-float" style="position:absolute;bottom:40px;right:-20px;z-index:10;">
                            {{-- <div
                                style="background:linear-gradient(135deg,#FBBF47,#D48A10);width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;color:white;box-shadow:0 6px 16px rgba(245,166,35,0.3);">
                                HS
                            </div> --}}
                        </div>

                        <!-- Dashboard card -->
                        <div class="mockup-card">
                            <!-- Header -->
                            <div
                                style="padding:20px 24px;border-bottom:1px solid #f0f0f0;display:flex;justify-content:space-between;align-items:center;">
                                <div>
                                    <p
                                        style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#aaa;font-weight:600;">
                                        Coloc · Maarif</p>
                                    <h3 style="font-size:22px;font-weight:800;margin-top:2px;">2,450.00 <span
                                            style="color:var(--amber);">DH</span></h3>
                                </div>
                                <div
                                    style="background:#ECFDF5;color:#065F46;padding:4px 12px;border-radius:99px;font-size:12px;font-weight:700;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg> À jour
                                </div>
                            </div>

                            <!-- Progress bars -->
                            <div style="padding:20px 24px;border-bottom:1px solid #f0f0f0;">
                                <p
                                    style="font-size:11px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;">
                                    Répartition du mois</p>
                                <div style="display:flex;flex-direction:column;gap:10px;">
                                    <div>
                                        <div
                                            style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:4px;">
                                            <span style="font-weight:600;"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="lucide lucide-home">
                                                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                                    <path
                                                        d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                                </svg> Loyer</span><span style="color:#888;">1,200 DH</span>
                                        </div>
                                        <div class="mockup-bar">
                                            <div class="mockup-bar-fill" style="width:70%;"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:4px;">
                                            <span style="font-weight:600;"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="lucide lucide-zap">
                                                    <path
                                                        d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                                                </svg> Eau & Élec</span><span style="color:#888;">350 DH</span>
                                        </div>
                                        <div class="mockup-bar">
                                            <div class="mockup-bar-fill" style="width:25%;opacity:0.7;"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:4px;">
                                            <span style="font-weight:600;"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="lucide lucide-shopping-cart">
                                                    <circle cx="8" cy="21" r="1" />
                                                    <circle cx="19" cy="21" r="1" />
                                                    <path
                                                        d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                                </svg> Courses</span><span style="color:#888;">450 DH</span>
                                        </div>
                                        <div class="mockup-bar">
                                            <div class="mockup-bar-fill" style="width:35%;opacity:0.6;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transactions -->
                            <div style="padding:16px 24px;">
                                <div style="display:flex;flex-direction:column;gap:10px;">
                                    <div
                                        style="display:flex;align-items:center;justify-content:space-between;padding:12px 14px;background:#f8f8f6;border-radius:14px;">
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div
                                                style="width:36px;height:36px;background:linear-gradient(135deg,#FDE68A,#F59E0B);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-shopping-cart">
                                                    <circle cx="8" cy="21" r="1" />
                                                    <circle cx="19" cy="21" r="1" />
                                                    <path
                                                        d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p style="font-size:13px;font-weight:700;">Carrefour Courses</p>
                                                <p style="font-size:11px;color:#aaa;">Payé par Youssef</p>
                                            </div>
                                        </div>
                                        <span style="font-size:13px;font-weight:800;color:#1b1b18;">-450 DH</span>
                                    </div>
                                    <div
                                        style="display:flex;align-items:center;justify-content:space-between;padding:12px 14px;background:#f8f8f6;border-radius:14px;opacity:0.6;">
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div
                                                style="width:36px;height:36px;background:#e0e0e0;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-zap">
                                                    <path
                                                        d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p style="font-size:13px;font-weight:700;">Facture Redal</p>
                                                <p style="font-size:11px;color:#aaa;">En attente</p>
                                            </div>
                                        </div>
                                        <span style="font-size:13px;font-weight:700;color:var(--amber);">Pending</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========== STATS TICKER =========== -->
    <div class="stats-strip">
        <div class="stats-ticker">
            <!-- duplicated for infinite loop -->
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">+120 Colocs
                    actives</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Casablanca · Rabat ·
                    Marrakech</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">+50,000 DH
                    gérés</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Zéro disputes garanties*</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">100% gratuit ·
                    BETA</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Calcul automatique des
                    dettes</span>
            </div>
            <!-- duplicate -->
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">+120 Colocs
                    actives</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Casablanca · Rabat ·
                    Marrakech</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">+50,000 DH
                    gérés</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Zéro disputes garanties*</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span style="color:white;font-size:13px;font-weight:500;">100% gratuit ·
                    BETA</span>
            </div>
            <div class="stat-item">
                <div class="stat-dot"></div><span
                    style="color:rgba(255,255,255,0.5);font-size:13px;font-weight:500;">Calcul automatique des
                    dettes</span>
            </div>
        </div>
    </div>

    <!-- =========== FEATURES =========== -->
    <section id="features" class="py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20" data-reveal data-reveal-dir="up">
                <p
                    style="color:var(--amber);font-size:12px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                    FONCTIONNALITÉS</p>
                <h2
                    style="font-family:'Playfair Display',serif;font-size:clamp(36px,4vw,52px);font-weight:900;margin-bottom:16px;">
                    Des comptes clairs,<br>une coloc <em style="color:var(--amber);">sereine</em>.</h2>
                <p style="color:#888;font-size:17px;max-width:480px;margin:0 auto;">Conçu pour les colocs marocains —
                    simple, rapide, en dirhams.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="feature-card p-8 rounded-3xl" style="background:#FDFDFC;border:1px solid #eee;"
                    data-reveal data-reveal-dir="up" data-reveal-delay="0.1s">
                    <div class="feature-icon" style="background:#FEF3C7;"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-zap">
                            <path
                                d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;">Ajout Express</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Ajoute une dépense en 3 secondes. Loyer,
                        courses, Internet — tout est tracké instantanément.</p>
                </div>
                <div class="feature-card p-8 rounded-3xl" style="background:#FDFDFC;border:1px solid #eee;"
                    data-reveal data-reveal-dir="up" data-reveal-delay="0.2s">
                    <div class="feature-icon" style="background:#D1FAE5;"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-calculator">
                            <rect width="16" height="20" x="4" y="2" rx="2" />
                            <line x1="8" x2="16" y1="6" y2="6" />
                            <line x1="16" x2="16" y1="14" y2="18" />
                            <path d="M16 10h.01" />
                            <path d="M12 10h.01" />
                            <path d="M8 10h.01" />
                            <path d="M12 14h.01" />
                            <path d="M8 14h.01" />
                            <path d="M12 18h.01" />
                            <path d="M8 18h.01" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;">Division Auto</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Partage égal ou personnalisé. L'algorithme
                        calcule qui doit quoi à qui, automatiquement.</p>
                </div>
                <div class="feature-card p-8 rounded-3xl" style="background:#FDFDFC;border:1px solid #eee;"
                    data-reveal data-reveal-dir="up" data-reveal-delay="0.3s">
                    <div class="feature-icon" style="background:#EDE9FE;"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bar-chart-3">
                            <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                            <path d="M18 17V9" />
                            <path d="M13 17V5" />
                            <path d="M8 17v-3" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;">Historique Complet</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Consulte l'historique de tous les paiements.
                        Clôture les dettes et repars proprement chaque mois.</p>
                </div>
                <div class="feature-card p-8 rounded-3xl" style="background:#FDFDFC;border:1px solid #eee;"
                    data-reveal data-reveal-dir="up" data-reveal-delay="0.1s">
                    <div class="feature-icon" style="background:#FEE2E2;"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bell">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;">Rappels Doux</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Envoie des rappels à tes colocs sans gêne. Le
                        système gère la partie awkward pour toi.</p>
                </div>
                <div class="feature-card p-8 rounded-3xl" style="background:#FDFDFC;border:1px solid #eee;"
                    data-reveal data-reveal-dir="up" data-reveal-delay="0.2s">
                    <div class="feature-icon" style="background:#E0F2FE;"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-tag">
                            <path
                                d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.59a2.426 2.426 0 0 0 0-3.42z" />
                            <circle cx="7.5" cy="7.5" r=".5" fill="currentColor" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;">Catégories</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Loyer, eau, élec, Marjane, Wifi — classe
                        chaque dépense et visualise où part le budget.</p>
                </div>
                <div class="feature-card p-8 rounded-3xl"
                    style="background:linear-gradient(135deg,#1b1b18,#2d2d28);border:1px solid #333;" data-reveal
                    data-reveal-dir="up" data-reveal-delay="0.3s">
                    <div class="feature-icon" style="background:rgba(245,166,35,0.15);"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shield-check">
                            <path
                                d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg></div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:10px;color:white;">100% Privé</h3>
                    <p style="color:rgba(255,255,255,0.5);line-height:1.7;font-size:15px;">Tes données restent entre
                        toi et tes colocs. Aucun accès tiers, jamais.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== HOW IT WORKS =========== -->
    <section style="background:var(--sand);padding:112px 0;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20" data-reveal data-reveal-dir="up">
                <p
                    style="color:var(--amber);font-size:12px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                    COMMENT ÇA MARCHE</p>
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(36px,4vw,52px);font-weight:900;">3
                    étapes, c'est tout.</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <div data-reveal data-reveal-dir="left" style="text-align:center;">
                    <div class="step-number">01</div>
                    <div
                        style="width:56px;height:56px;background:var(--amber);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-home">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                    </div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:8px;">Crée ta coloc</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Invites tes colocataires par email. En 1
                        minute, votre groupe est prêt.</p>
                </div>
                <div data-reveal data-reveal-dir="scale" data-reveal-delay="0.15s" style="text-align:center;">
                    <div class="step-number">02</div>
                    <div
                        style="width:56px;height:56px;background:var(--amber);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-banknote">
                            <rect width="20" height="12" x="2" y="6" rx="2" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M6 12h.01M18 12h.01" />
                        </svg>
                    </div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:8px;">Ajoute les dépenses</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Qui a payé quoi, quand, et pour qui. Le
                        système fait les calculs à ta place.</p>
                </div>
                <div data-reveal data-reveal-dir="right" data-reveal-delay="0.2s" style="text-align:center;">
                    <div class="step-number">03</div>
                    <div
                        style="width:56px;height:56px;background:var(--amber);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-check-circle-2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 style="font-size:20px;font-weight:800;margin-bottom:8px;">Règle & Recommence</h3>
                    <p style="color:#888;line-height:1.7;font-size:15px;">Marque les remboursements. Nouvelle page,
                        chaque mois, sans stress.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== TESTIMONIALS =========== -->
    <section class="testimonials-section py-28">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-reveal data-reveal-dir="up">
                <p
                    style="color:var(--amber);font-size:12px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                    ILS EN PARLENT</p>
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(32px,4vw,48px);font-weight:900;">Nos
                    colocs témoignent <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg></h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="testimonial-card" data-reveal data-reveal-dir="up" data-reveal-delay="0.1s">
                    <div class="quote-mark">"</div>
                    <p style="color:#444;line-height:1.7;font-size:15px;margin:8px 0 20px;">Kont katkhesem m3a coloci f
                        kol shhar. Daba avec Hsab Sabon kol wahad 3aref shhal khasso. Raha f dar!</p>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="avatar-ring" style="background:#FDE68A;color:#92400E;">YB</div>
                        <div>
                            <p style="font-weight:700;font-size:14px;">Youssef B.</p>
                            <p style="color:#aaa;font-size:12px;">Coloc Maarif · Casa</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-reveal data-reveal-dir="up" data-reveal-delay="0.2s">
                    <div class="quote-mark">"</div>
                    <p style="color:#444;line-height:1.7;font-size:15px;margin:8px 0 20px;">Simple, claire, et en
                        dirhams. C'est exactement ce qu'on cherchait. Le calcul automatique est top!</p>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="avatar-ring" style="background:#D1FAE5;color:#065F46;">AI</div>
                        <div>
                            <p style="font-weight:700;font-size:14px;">Amina I.</p>
                            <p style="color:#aaa;font-size:12px;">Coloc Agdal · Rabat</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-reveal data-reveal-dir="up" data-reveal-delay="0.3s">
                    <div class="quote-mark">"</div>
                    <p style="color:#444;line-height:1.7;font-size:15px;margin:8px 0 20px;">On est 4 dans l'appart.
                        Avant c'était le bordel avec les transferts. Maintenant tout est transparent. Nti9a!</p>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="avatar-ring" style="background:#EDE9FE;color:#5B21B6;">KM</div>
                        <div>
                            <p style="font-weight:700;font-size:14px;">Karim M.</p>
                            <p style="color:#aaa;font-size:12px;">Coloc Guéliz · Marrakech</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== CTA =========== -->
    <section class="cta-section py-28">
        <div class="moroccan-pattern"></div>
        <div class="max-w-3xl mx-auto px-6 text-center relative z-10" data-reveal data-reveal-dir="scale"
            data-reveal-delay="0.1s">
            <!-- Big dirham coin -->
            <div
                style="width:80px;height:80px;background:linear-gradient(135deg,#FBBF47,#D48A10);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;box-shadow:0 20px 60px rgba(245,166,35,0.4);font-size:32px;font-weight:900;color:white;font-family:'Instrument Sans';">
                HS
            </div>
            <h2
                style="font-family:'Playfair Display',serif;font-size:clamp(36px,5vw,60px);font-weight:900;color:white;line-height:1.1;margin-bottom:20px;">
                Prêt à gérer ta<br>coloc <em style="color:var(--amber);">comme un pro</em> ?
            </h2>
            <p style="color:rgba(255,255,255,0.5);font-size:17px;margin-bottom:40px;line-height:1.7;">
                Rejoins des centaines de colocs marocains.<br>Gratuit, pour toujours en BETA.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="btn-primary" style="font-size:17px;padding:18px 36px;">
                    Créer mon compte <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="btn-secondary" style="font-size:17px;padding:18px 36px;">
                    J'ai déjà un compte
                </a>
            </div>
            <p style="color:rgba(255,255,255,0.2);font-size:12px;margin-top:24px;">
                Aucune carte bancaire requise · Inscription en 30 secondes
            </p>
        </div>
    </section>

    <!-- =========== FOOTER =========== -->
    <footer style="border-top:1px solid #f0f0f0;padding:40px 0;background:white;">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div style="display:flex;align-items:center;gap:8px;">
                <div
                    style="width:32px;height:32px;background:var(--amber);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <span style="color:white;font-weight:700;font-size:11px;">HS</span>
                </div>
                <span style="color:#888;font-size:13px;">© 2026 Hsab Sabon · L.Ismail</span>
            </div>
            <div style="display:flex;gap:24px;">
                <a href="{{ route('legal.privacy') }}"
                    style="color:#aaa;font-size:13px;font-weight:500;text-decoration:none;">Confidentialité</a>
                <a href="{{ route('legal.cgu') }}"
                    style="color:#aaa;font-size:13px;font-weight:500;text-decoration:none;">CGU</a>
                <a href="{{ route('contact.index') }}"
                    style="color:#aaa;font-size:13px;font-weight:500;text-decoration:none;">Contact</a>
            </div>
        </div>
    </footer>

    <!-- =========== SCRIPTS =========== -->
    <script>
        // -- Loading screen --
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loading-screen').classList.add('hide');
                setTimeout(() => {
                    document.getElementById('loading-screen').style.display = 'none';
                }, 900);
            }, 2000);
        });

        // -- Scroll reveal --
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12
        });
        document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));

        // -- Navbar scroll --
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
        });
    </script>
</body>

</html>
