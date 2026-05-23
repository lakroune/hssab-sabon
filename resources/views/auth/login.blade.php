<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion · Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #0f0f0d;
            min-height: 100vh;
            display: flex;
        }

        /* -- LEFT PANEL -- */
        .left-panel {
            width: 52%;
            background: #1b1b18;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
        }

        @media (max-width: 900px) {
            .left-panel {
                display: none;
            }
        }

        /* animated mosaic bg */
        .mosaic-bg {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(60deg, rgba(245, 166, 35, 0.06) 0, rgba(245, 166, 35, 0.06) 1px, transparent 1px, transparent 44px),
                repeating-linear-gradient(-60deg, rgba(245, 166, 35, 0.06) 0, rgba(245, 166, 35, 0.06) 1px, transparent 1px, transparent 44px),
                repeating-linear-gradient(0deg, rgba(245, 166, 35, 0.03) 0, rgba(245, 166, 35, 0.03) 1px, transparent 1px, transparent 44px);
            animation: mosaicDrift 12s linear infinite;
        }

        @keyframes mosaicDrift {
            0% {
                background-position: 0 0, 0 0, 0 0;
            }

            100% {
                background-position: 88px 88px, -88px 88px, 0 44px;
            }
        }

        /* amber glow blobs */
        .glow-1 {
            position: absolute;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.14), transparent 70%);
            border-radius: 50%;
            top: -80px;
            left: -80px;
            animation: blobPulse 5s ease-in-out infinite;
        }

        .glow-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.08), transparent 70%);
            border-radius: 50%;
            bottom: 40px;
            right: -60px;
            animation: blobPulse 6s ease-in-out infinite reverse;
        }

        @keyframes blobPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }
        }

        /* brand logo top */
        .panel-brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            color: white;
            box-shadow: 0 8px 20px rgba(245, 166, 35, 0.4);
        }

        .panel-brand-name {
            font-size: 16px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.02em;
        }

        /* center content */
        .panel-content {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* big coin */
        .big-coin {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #FBBF47 30%, #D48A10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            color: white;
            margin-bottom: 32px;
            box-shadow:
                0 0 0 16px rgba(245, 166, 35, 0.06),
                0 0 0 32px rgba(245, 166, 35, 0.03),
                0 20px 60px rgba(245, 166, 35, 0.4);
            animation: coinFloat 3.5s ease-in-out infinite;
        }

        @keyframes coinFloat {

            0%,
            100% {
                transform: translateY(0) rotate(-3deg);
            }

            50% {
                transform: translateY(-12px) rotate(3deg);
            }
        }

        .panel-headline {
            font-family: 'Playfair Display', serif;
            font-size: 46px;
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .panel-headline em {
            color: #F5A623;
        }

        .panel-sub {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.7;
            max-width: 340px;
        }

        /* stats at bottom */
        .panel-stats {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 32px;
        }

        .stat-block {}

        .stat-block .num {
            font-size: 22px;
            font-weight: 800;
            color: white;
        }

        .stat-block .num span {
            color: #F5A623;
        }

        .stat-block .label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 2px;
        }

        .stat-sep {
            width: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        /* -- RIGHT PANEL (FORM) -- */
        .right-panel {
            flex: 1;
            background: #FDFDFC;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
        }

        /* subtle top stripe */
        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #F5A623, #FBBF47, #F5A623);
            background-size: 200% 100%;
            animation: stripeShimmer 2s linear infinite;
        }

        @keyframes stripeShimmer {
            0% {
                background-position: 0% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            animation: formSlideIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes formSlideIn {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-eyebrow {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #F5A623;
            margin-bottom: 8px;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 34px;
            font-weight: 900;
            color: #1b1b18;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #999;
            margin-bottom: 36px;
        }

        /* inputs */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #1b1b18;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
            font-size: 16px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .field input {
            width: 100%;
            padding: 13px 14px 13px 40px;
            background: white;
            border: 1.5px solid #e8e8e4;
            border-radius: 12px;
            font-size: 14px;
            color: #1b1b18;
            font-family: 'Instrument Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input::placeholder {
            color: #c0bdb8;
        }

        .field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
        }

        .field input:focus~.input-icon,
        .input-wrap:focus-within .input-icon {
            color: #F5A623;
        }

        /* password toggle */
        .pass-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #ccc;
            font-size: 14px;
            transition: color 0.2s;
            padding: 4px;
        }

        .pass-toggle:hover {
            color: #F5A623;
        }

        /* row: remember + forgot */
        .row-mid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #F5A623;
            border-radius: 4px;
            cursor: pointer;
        }

        .remember span {
            font-size: 13px;
            color: #888;
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 600;
            color: #F5A623;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #D48A10;
        }

        /* submit button */
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            color: #1b1b18;
            font-weight: 800;
            font-size: 15px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-family: 'Instrument Sans', sans-serif;
            box-shadow: 0 8px 24px rgba(245, 166, 35, 0.35);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.01em;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245, 166, 35, 0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #ebebeb;
        }

        .divider span {
            font-size: 12px;
            color: #ccc;
        }

        /* register link */
        .register-row {
            text-align: center;
        }

        .register-row p {
            font-size: 13px;
            color: #999;
        }

        .register-row a {
            font-weight: 700;
            color: #1b1b18;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-row a:hover {
            color: #F5A623;
        }

        /* session status */
        .session-status {
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            color: #065F46;
            margin-bottom: 20px;
        }

        /* error */
        .field-error {
            font-size: 12px;
            color: #EF4444;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* mobile brand bar */
        .mobile-brand {
            display: none;
            align-items: center;
            gap: 8px;
            margin-bottom: 36px;
        }

        @media (max-width: 900px) {
            .mobile-brand {
                display: flex;
            }

            .right-panel {
                padding: 40px 24px;
            }
        }
    </style>

</head>

<body>

    <!-- ============ LEFT PANEL ============ -->
    <div class="left-panel">
        <div class="mosaic-bg"></div>
        <div class="glow-1"></div>
        <div class="glow-2"></div>

        <!-- Brand top -->
        <div class="panel-brand">
            <div class="panel-brand-icon">HS</div>
            <span class="panel-brand-name">Hsab Sabon</span>
        </div>

        <!-- Center copy -->
        <div class="panel-content">
            {{-- <div class="big-coin">H.S</div> --}}
            <h2 class="panel-headline">
                Bienvenue<br>dans ta <em>coloc</em><br>sans stress.
            </h2>
            <p class="panel-sub">
                Gère tes dépenses partagées en dirhams.
                Loyer, courses, factures — tout est clair entre colocs.
            </p>
        </div>

        <!-- Stats bottom -->
        <div class="panel-stats">
            <div class="stat-block">
                <div class="num">+120<span>k</span></div>
                <div class="label">Colocs actives</div>
            </div>
            <div class="stat-sep"></div>
            <div class="stat-block">
                <div class="num">50k <span>DH</span></div>
                <div class="label">Gérés ce mois</div>
            </div>
            <div class="stat-sep"></div>
            <div class="stat-block">
                <div class="num">100<span>%</span></div>
                <div class="label">Gratuit BETA</div>
            </div>
        </div>
    </div>

    <!-- ============ RIGHT PANEL ============ -->
    <div class="right-panel">
        <div class="form-box">

            <!-- Mobile brand -->
            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <p class="form-eyebrow">Espace membre</p>
            <h1 class="form-title">Connexion</h1>
            <p class="form-subtitle">Bon retour dans ta coloc <svg xmlns="http://www.w3.org/2000/svg" width="18"
                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hand">
                    <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0" />
                    <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2" />
                    <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8" />
                    <path
                        d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15" />
                </svg></p>

            <!-- Session status -->
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="field">
                    <label for="email">Adresse email</label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg></span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="ton@email.com" required autofocus autocomplete="username" />
                    </div>
                    @error('email')
                        <p class="field-error"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg></span>
                        <input id="password" type="password" name="password" placeholder="••••••••" required
                            autocomplete="current-password" />
                        <button type="button" class="pass-toggle" id="togglePass"
                            aria-label="Afficher le mot de passe">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="field-error"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="row-mid">
                    <label class="remember">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <span>Se connecter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </button>
            </form>

            <div class="divider"><span>ou</span></div>

            <!-- Register -->
            <div class="register-row">
                <p>
                    Pas encore de compte ?
                    <a href="{{ route('register') }}">Créer un compte</a>
                </p>
            </div>

        </div>
    </div>

    <script>
        // Password toggle
        const toggleBtn = document.getElementById('togglePass');
        const passInput = document.getElementById('password');

        // SVG icons as constants
        const iconEye =
            `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>`;
        const iconEyeOff =
            `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>`;

        if (toggleBtn && passInput) {
            toggleBtn.addEventListener('click', () => {
                const isPass = passInput.type === 'password';
                passInput.type = isPass ? 'text' : 'password';
                // Use innerHTML to render SVG, NOT textContent
                toggleBtn.innerHTML = isPass ? iconEyeOff : iconEye;
            });
        }
    </script>
</body>

</html>
