<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Hsab Sabon' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #FAFAF8;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .guest-topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(253,253,252,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #f0f0ec;
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .topbar-brand-icon {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 11px;
            color: white;
            box-shadow: 0 4px 12px rgba(245,166,35,0.35);
            flex-shrink: 0;
        }

        .topbar-brand-name {
            font-size: 14px;
            font-weight: 700;
            color: #1b1b18;
            letter-spacing: -0.01em;
        }

        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-nav a {
            font-size: 11px;
            font-weight: 700;
            color: #999;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 6px 12px;
            border-radius: 8px;
            transition: color 0.15s, background 0.15s;
        }

        .topbar-nav a:hover {
            color: #1b1b18;
            background: #f5f5f2;
        }

        .topbar-nav a.active {
            color: #F5A623;
            background: #FFFBEB;
        }

        .topbar-login {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-login {
            font-size: 11px;
            font-weight: 700;
            color: #1b1b18;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 8px 16px;
            border: 1.5px solid #e8e8e4;
            border-radius: 10px;
            transition: border-color 0.2s, background 0.2s;
        }

        .btn-login:hover {
            border-color: #F5A623;
            background: #FFFBEB;
        }

        .btn-signup {
            font-size: 11px;
            font-weight: 800;
            color: #1b1b18;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 8px 16px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(245,166,35,0.3);
            transition: all 0.2s;
        }

        .btn-signup:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(245,166,35,0.4);
        }

        /* ── MAIN ── */
        .guest-main {
            min-height: calc(100vh - 56px - 80px);
        }

        /* ── FOOTER ── */
        .guest-footer {
            border-top: 1px solid #f0f0ec;
            background: white;
            padding: 24px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-brand-dot {
            width: 8px; height: 8px;
            background: #F5A623;
            border-radius: 50%;
        }

        .footer-copy {
            font-size: 11px;
            color: #bbb;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .footer-links a {
            font-size: 11px;
            font-weight: 600;
            color: #bbb;
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-links a:hover { color: #F5A623; }

        .footer-links a.active { color: #F5A623; }

        @media (max-width: 640px) {
            .topbar-nav { display: none; }
            .guest-topbar { padding: 0 16px; }
            .guest-footer { flex-direction: column; align-items: flex-start; gap: 16px; }
        }
    </style>
</head>
<body>

    <!-- TOPBAR -->
    <header class="guest-topbar">
        <a href="{{ url('/') }}" class="topbar-brand">
            <div class="topbar-brand-icon">HS</div>
            <span class="topbar-brand-name">Hsab Sabon</span>
        </a>

        <nav class="topbar-nav">
            <a href="{{ route('legal.privacy') }}" class="{{ request()->routeIs('legal.privacy') ? 'active' : '' }}">
                Confidentialité
            </a>
            <a href="{{ route('legal.cgu') }}" class="{{ request()->routeIs('legal.cgu') ? 'active' : '' }}">
                CGU
            </a>
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
                Contact
            </a>
        </nav>

        <div class="topbar-login">
            @auth
                <a href="{{ route('colocations.index') }}" class="btn-signup">Mon espace</a>
            @else
                <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                <a href="{{ route('register') }}" class="btn-signup">S'inscrire</a>
            @endauth
        </div>
    </header>

    <!-- CONTENT -->
    <main class="guest-main">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="guest-footer">
        <div class="footer-brand">
            <div class="footer-brand-dot"></div>
            <span class="footer-copy">© {{ date('Y') }} Hsab Sabon · Version BETA · Maroc</span>
        </div>
        <div class="footer-links">
            <a href="{{ route('legal.privacy') }}" class="{{ request()->routeIs('legal.privacy') ? 'active' : '' }}">
                Confidentialité
            </a>
            <a href="{{ route('legal.cgu') }}" class="{{ request()->routeIs('legal.cgu') ? 'active' : '' }}">
                CGU
            </a>
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
                Contact
            </a>
        </div>
    </footer>

</body>
</html>