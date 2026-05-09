<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hsab Sabon | Easy Coloc</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #FDFDFC;
            color: #1b1b18;
            overflow-x: hidden;
        }

        /* ===== SCROLL ANIMATIONS ===== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-60px);
            transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(60px);
            transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.85);
            transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-scale.active {
            opacity: 1;
            transform: scale(1);
        }

        .reveal-rotate {
            opacity: 0;
            transform: rotate(-8deg) scale(0.9);
            transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-rotate.active {
            opacity: 1;
            transform: rotate(0) scale(1);
        }

        /* Stagger delays */
        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
        }

        .delay-3 {
            transition-delay: 0.3s;
        }

        .delay-4 {
            transition-delay: 0.4s;
        }

        .delay-5 {
            transition-delay: 0.5s;
        }

        /* Navbar */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            max-width: 1280px;
            margin: 0 auto;
            border-bottom: 1px solid #f3f4f6;
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(253, 253, 252, 0.85);
            backdrop-filter: blur(12px);
            transition: box-shadow 0.3s ease;
        }

        nav.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo-icon {
            width: 40px;
            height: 40px;
            background: #fbbf24;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.4s ease;
        }

        .nav-logo:hover .nav-logo-icon {
            transform: rotate(12deg) scale(1.1);
        }

        .nav-logo-icon span {
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
        }

        .nav-logo-text {
            font-weight: 600;
            font-size: 1.125rem;
            letter-spacing: -0.025em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #1b1b18;
            font-size: 0.875rem;
            font-weight: 500;
            position: relative;
            padding: 4px 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #fbbf24;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn-primary {
            padding: 8px 16px;
            background: #1b1b18;
            color: white;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #fbbf24;
            color: #1b1b18;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.3);
        }

        /* Hero */
        .hero {
            max-width: 1280px;
            margin: 0 auto;
            padding: 64px 24px 96px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 48px;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .hero {
                grid-template-columns: 1fr 1fr;
                gap: 48px;
            }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 12px;
            border-radius: 9999px;
            background: #fffbeb;
            border: 1px solid #fef3c7;
            color: #b45309;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 24px;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.4);
            }

            50% {
                box-shadow: 0 0 0 8px rgba(251, 191, 36, 0);
            }
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 24px;
        }

        @media (min-width: 1024px) {
            .hero h1 {
                font-size: 4.5rem;
            }
        }

        .hero h1 .highlight {
            color: #fbbf24;
            font-style: italic;
            display: inline-block;
            position: relative;
        }

        .hero h1 .highlight::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(251, 191, 36, 0.3);
            border-radius: 4px;
            z-index: -1;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.6s ease 0.5s;
        }

        .reveal-left.active .highlight::after {
            transform: scaleX(1);
        }

        .hero p {
            color: #6b7280;
            font-size: 1.125rem;
            line-height: 1.625;
            margin-bottom: 32px;
            max-width: 576px;
        }

        .hero-buttons {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        @media (min-width: 640px) {
            .hero-buttons {
                flex-direction: row;
            }
        }

        .btn-cta {
            padding: 16px 32px;
            background: #fbbf24;
            color: #1b1b18;
            font-weight: 700;
            border-radius: 12px;
            font-size: 1.125rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.2);
        }

        .btn-cta:hover {
            background: #fcd34d;
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(251, 191, 36, 0.35);
        }

        .btn-outline {
            padding: 16px 32px;
            background: white;
            border: 1px solid #e5e7eb;
            font-weight: 600;
            border-radius: 12px;
            font-size: 1.125rem;
            text-align: center;
            text-decoration: none;
            color: #1b1b18;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-2px);
        }

        /* Hero Card */
        .hero-visual {
            position: relative;
        }

        .hero-blob {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 256px;
            height: 256px;
            background: #fef3c7;
            border-radius: 50%;
            filter: blur(64px);
            opacity: 0.5;
            animation: blob-float 6s ease-in-out infinite;
        }

        @keyframes blob-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(20px, -20px) scale(1.1);
            }

            66% {
                transform: translate(-10px, 10px) scale(0.95);
            }
        }

        .hero-card {
            position: relative;
            background: white;
            border: 1px solid #f3f4f6;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .hero-card:hover {
            transform: translateY(-8px) rotate(1deg);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 32px;
        }

        .card-header-label {
            color: #9ca3af;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.1em;
        }

        .card-header-value {
            font-size: 1.875rem;
            font-weight: 900;
        }

        .card-badge {
            background: #dcfce7;
            color: #15803d;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            animation: bounce-in 0.6s ease 0.8s both;
        }

        @keyframes bounce-in {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .card-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: #f9fafb;
            border-radius: 16px;
            border: 1px solid #f3f4f6;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card-item:hover {
            background: #fffbeb;
            border-color: #fcd34d;
            transform: translateX(4px);
        }

        .card-item:last-child {
            margin-bottom: 0;
        }

        .card-item-dim {
            opacity: 0.6;
        }

        .card-item-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .card-item-info {
            flex: 1;
            margin-left: 12px;
        }

        .card-item-title {
            font-weight: 700;
            font-size: 0.875rem;
        }

        .card-item-sub {
            color: #9ca3af;
            font-size: 0.75rem;
        }

        .card-item-amount {
            font-weight: 700;
            font-size: 0.875rem;
        }

        .card-item-pending {
            color: #d97706;
            font-style: italic;
        }

        /* Features */
        .features {
            padding: 96px 24px;
            background: white;
            border-top: 1px solid #f3f4f6;
        }

        .features-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .features-header {
            text-align: center;
            max-width: 768px;
            margin: 0 auto 80px;
        }

        .features-label {
            color: #fbbf24;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 0.875rem;
            margin-bottom: 16px;
            display: inline-block;
        }

        .features-title {
            font-size: 2.25rem;
            font-weight: 900;
            color: #1b1b18;
            margin-bottom: 24px;
        }

        .features-sub {
            color: #6b7280;
            font-size: 1.125rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
        }

        @media (min-width: 768px) {
            .features-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .feature-card {
            padding: 32px;
            border-radius: 24px;
            background: #FDFDFC;
            border: 1px solid #f3f4f6;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24, #fcd34d);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: #fcd34d;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: #fbbf24;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
            transition: transform 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: rotate(12deg) scale(1.1);
        }

        .feature-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.625;
        }

        /* Footer */
        footer {
            border-top: 1px solid #f3f4f6;
            padding: 48px 24px;
            background: white;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

        @media (min-width: 768px) {
            .footer-inner {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .footer-links {
            display: flex;
            gap: 32px;
        }

        .footer-links a {
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #fbbf24;
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #fbbf24;
            transition: width 0.3s ease;
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Counter animation */
        .counter {
            display: inline-block;
        }
    </style>
    <base target="_blank">
</head>

<body>

    <nav id="navbar">
        <div class="nav-logo">
            <div class="nav-logo-icon">
                <span>HS</span>
            </div>
            <span class="nav-logo-text">Hsab Sabon</span>
        </div>
        <div class="nav-links">
            <a href="#features">How it works</a>
            <a href="#" class="btn-primary">Get Started</a>
        </div>
    </nav>

    <main class="hero">
        <div>
            <div class="badge reveal">
                BETA 1.0
            </div>
            <h1 class="reveal-left delay-1">
                Manage your <span class="highlight">Coloc</span> expenses easily.
            </h1>
            <p class="reveal delay-2">
                Keep your shared apartment finances clean. Track debts, split bills, and manage group expenses without
                stress.
            </p>
            <div class="hero-buttons reveal delay-3">
                <a href="#" class="btn-cta">Start Tracking Now</a>
                <a href="#features" class="btn-outline">How it works</a>
            </div>
        </div>

        <div class="hero-visual reveal-right delay-2">
            <div class="hero-blob"></div>
            <div class="hero-card">
                <div class="card-header">
                    <div>
                        <p class="card-header-label">Total Spent</p>
                        <h3 class="card-header-value" id="counter">0.00 DH</h3>
                    </div>
                    <div class="card-badge">+12%</div>
                </div>
                <div class="space-y-4">
                    <div class="card-item">
                        <div style="display:flex;align-items:center;gap:12px;flex:1;">
                            <div class="card-item-avatar" style="background:#fde68a;"></div>
                            <div class="card-item-info">
                                <p class="card-item-title">Grocery Shopping</p>
                                <p class="card-item-sub">Paid by Member</p>
                            </div>
                        </div>
                        <span class="card-item-amount">-450 DH</span>
                    </div>
                    <div class="card-item card-item-dim">
                        <div style="display:flex;align-items:center;gap:12px;flex:1;">
                            <div class="card-item-avatar" style="background:#d1d5db;"></div>
                            <div class="card-item-info">
                                <p class="card-item-title">Electricity Bill</p>
                                <p class="card-item-sub">Pending split</p>
                            </div>
                        </div>
                        <span class="card-item-amount card-item-pending">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section id="features" class="features">
        <div class="features-inner">
            <div class="features-header">
                <span class="features-label reveal">Features</span>
                <p class="features-title reveal delay-1">Clean accounts for clear minds</p>
                <p class="features-sub reveal delay-2">Tools designed for modern roommates to handle money fairly.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal-scale delay-1">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3>Quick Tracking</h3>
                    <p>Add expenses in seconds. Track rent, utilities, or shared groceries instantly.</p>
                </div>

                <div class="feature-card reveal-scale delay-2">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>
                    </div>
                    <h3>Smart Splitting</h3>
                    <p>Split bills equally or custom amounts. The system calculates debts automatically.</p>
                </div>

                <div class="feature-card reveal-scale delay-3">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h3>Settle Up</h3>
                    <p>Keep a clean history of all payments. Clear debts and start fresh every month.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-inner">
            <p>&copy; 2026 HSAB SABON. Ismail Lakroune.</p>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        // ===== SCROLL REVEAL =====
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    // Animate counter when card is visible
                    if (entry.target.querySelector('#counter') || entry.target.id === 'counter') {
                        animateCounter();
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .reveal-rotate').forEach(el => {
            revealObserver.observe(el);
        });

        // Also observe the hero card specifically for counter
        const heroCard = document.querySelector('.hero-card');
        if (heroCard) {
            revealObserver.observe(heroCard);
        }

        // ===== COUNTER ANIMATION =====
        let counterAnimated = false;

        function animateCounter() {
            if (counterAnimated) return;
            counterAnimated = true;
            const el = document.getElementById('counter');
            const target = 2450;
            const duration = 2000;
            const start = performance.now();

            function update(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
                const current = (eased * target).toFixed(2);
                el.textContent = current.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' DH';
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            requestAnimationFrame(update);
        }

        // ===== NAVBAR SCROLL EFFECT =====
        const navbar = document.getElementById('navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            lastScroll = currentScroll;
        });

        // ===== PARALLAX BLOB =====
        const blob = document.querySelector('.hero-blob');
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            if (blob) {
                blob.style.transform = `translateY(${scrolled * 0.15}px)`;
            }
        });

        // ===== MOUSE PARALLAX ON HERO CARD =====
        const heroCardEl = document.querySelector('.hero-card');
        const heroVisual = document.querySelector('.hero-visual');

        if (heroVisual && heroCardEl) {
            heroVisual.addEventListener('mousemove', (e) => {
                const rect = heroVisual.getBoundingClientRect();
                const x = (e.clientX - rect.left - rect.width / 2) / 25;
                const y = (e.clientY - rect.top - rect.height / 2) / 25;
                heroCardEl.style.transform =
                    `perspective(1000px) rotateY(${x}deg) rotateX(${-y}deg) translateZ(10px)`;
            });

            heroVisual.addEventListener('mouseleave', () => {
                heroCardEl.style.transform = 'perspective(1000px) rotateY(0) rotateX(0) translateZ(0)';
            });
        }

        // Trigger initial animations for above-fold elements
        setTimeout(() => {
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach((el, i) => {
                setTimeout(() => el.classList.add('active'), i * 150);
            });
            setTimeout(animateCounter, 600);
        }, 300);
    </script>

</body>

</html>
