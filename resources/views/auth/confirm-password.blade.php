<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmer le mot de passe · Hsab Sabon</title>
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

        /* ── LEFT PANEL ── */
        .left-panel {
            width: 46%;
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

        .glow-blob {
            position: absolute;
            border-radius: 50%;
            animation: blobPulse 5s ease-in-out infinite;
        }

        .glow-1 {
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.11), transparent 70%);
            top: -40px;
            left: -80px;
        }

        .glow-2 {
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.07), transparent 70%);
            bottom: 80px;
            right: -40px;
            animation-duration: 7s;
            animation-direction: reverse;
        }

        @keyframes blobPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.12);
                opacity: 0.7;
            }
        }

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

        .panel-content {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Shield visual */
        .shield-wrap {
            position: relative;
            width: 110px;
            margin-bottom: 36px;
        }

        .shield-outer {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: shieldPulse 3s ease-in-out infinite;
        }

        .shield-inner {
            width: 70px;
            height: 70px;
            background: rgba(245, 166, 35, 0.08);
            border: 1px solid rgba(245, 166, 35, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        @keyframes shieldPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(245, 166, 35, 0);
            }

            50% {
                box-shadow: 0 0 0 12px rgba(245, 166, 35, 0.06);
            }
        }

        .shield-badge {
            position: absolute;
            bottom: 4px;
            right: 0;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            box-shadow: 0 4px 12px rgba(245, 166, 35, 0.45);
            animation: badgePop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
        }

        @keyframes badgePop {
            from {
                transform: scale(0) rotate(-20deg);
            }

            to {
                transform: scale(1) rotate(0deg);
            }
        }

        .panel-headline {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 14px;
        }

        .panel-headline em {
            color: #F5A623;
        }

        .panel-sub {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.7;
            max-width: 300px;
            margin-bottom: 32px;
        }

        /* security badges */
        .security-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .sec-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 99px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.35);
        }

        .sec-pill span:first-child {
            font-size: 13px;
        }

        /* user card bottom */
        .user-card {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 14px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            color: white;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .user-status {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.3);
            margin-top: 2px;
        }

        .user-lock {
            font-size: 18px;
            opacity: 0.4;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            flex: 1;
            background: #FDFDFC;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
        }

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
            font-size: 32px;
            font-weight: 900;
            color: #1b1b18;
            line-height: 1.1;
            margin-bottom: 8px;
        }

        .form-desc {
            font-size: 14px;
            color: #999;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        /* secure area banner */
        .secure-banner {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
            border: 1px solid #FDE68A;
            border-radius: 12px;
            margin-bottom: 28px;
        }

        .secure-banner-icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .secure-banner-text {
            font-size: 12px;
            color: #78350F;
            line-height: 1.5;
        }

        .secure-banner-text strong {
            color: #92400E;
        }

        /* field */
        .field {
            margin-bottom: 8px;
        }

        .field label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #1b1b18;
            letter-spacing: 0.07em;
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
            color: #d0cdc8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap:focus-within .input-icon {
            color: #F5A623;
        }

        .field input {
            width: 100%;
            padding: 14px 44px 14px 42px;
            background: white;
            border: 1.5px solid #e8e8e4;
            border-radius: 12px;
            font-size: 15px;
            color: #1b1b18;
            font-family: 'Instrument Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            letter-spacing: 0.12em;
        }

        .field input::placeholder {
            color: #c8c5c0;
            letter-spacing: normal;
        }

        .field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
        }

        .pass-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #ccc;
            font-size: 15px;
            transition: color 0.2s;
            padding: 4px;
        }

        .pass-toggle:hover {
            color: #F5A623;
        }

        .field-error {
            font-size: 12px;
            color: #EF4444;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* attempts hint */
        .attempts-hint {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #bbb;
            margin-top: 8px;
            margin-bottom: 24px;
        }

        .attempts-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #e0e0e0;
            transition: background 0.3s;
        }

        .attempts-dot.used {
            background: #EF4444;
        }

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
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245, 166, 35, 0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
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

        .nav-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link {
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            color: #aaa;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-link:hover {
            color: #1b1b18;
        }

        .nav-link.danger:hover {
            color: #EF4444;
        }

        .mobile-brand {
            display: none;
            align-items: center;
            gap: 8px;
            margin-bottom: 32px;
        }

        @media (max-width: 900px) {
            .mobile-brand {
                display: flex;
            }

            .right-panel {
                padding: 48px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- ════════════ LEFT PANEL ════════════ -->
    <div class="left-panel">
        <div class="mosaic-bg"></div>
        <div class="glow-blob glow-1"></div>
        <div class="glow-blob glow-2"></div>

        <div class="panel-brand">
            <div class="panel-brand-icon">HS</div>
            <span class="panel-brand-name">Hsab Sabon</span>
        </div>

        <div class="panel-content">
            <!-- Shield visual -->
            <div class="shield-wrap">
                <div class="shield-outer">
                    <div class="shield-inner">🛡️</div>
                </div>
                <div class="shield-badge">✓</div>
            </div>

            <h2 class="panel-headline">
                Zone<br>
                <em>sécurisée</em>.
            </h2>
            <p class="panel-sub">
                Tu accèdes à une section sensible de ta coloc.
                Confirme ton identité pour continuer en toute sécurité.
            </p>

            <div class="security-pills">
                <div class="sec-pill"><span>🔒</span><span>Connexion chiffrée</span></div>
                <div class="sec-pill"><span>⏱</span><span>Session active</span></div>
                <div class="sec-pill"><span>🇲🇦</span><span>Données au Maroc</span></div>
            </div>
        </div>

        <!-- Logged-in user card -->
        <div class="user-card">
            <div class="user-avatar">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? 'Utilisateur' }}</div>
                <div class="user-status">Connecté · Confirmation requise</div>
            </div>
            <span class="user-lock">🔐</span>
        </div>
    </div>

    <!-- ════════════ RIGHT PANEL ════════════ -->
    <div class="right-panel">
        <div class="form-box">

            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <p class="form-eyebrow">Vérification de sécurité</p>
            <h1 class="form-title">Confirme ton<br>mot de passe</h1>
            <p class="form-desc">
                Pour protéger ta coloc, confirme ton identité
                avant d'accéder à cette section.
            </p>

            <!-- Secure area banner -->
            <div class="secure-banner">
                <span class="secure-banner-icon">🔐</span>
                <span class="secure-banner-text">
                    <strong>Zone sécurisée</strong> — Cette action nécessite
                    une confirmation de ton mot de passe actuel.
                </span>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="field">
                    <label for="password">Mot de passe actuel</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input id="password" type="password" name="password" placeholder="••••••••" required
                            autocomplete="current-password" oninput="onType()" />
                        <button type="button" class="pass-toggle" id="toggleBtn">👁</button>
                    </div>
                    @error('password')
                        <p class="field-error">⚠ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Attempts indicator -->
                <div class="attempts-hint" id="attemptsHint" style="display:none;">
                    <div class="attempts-dot" id="d1"></div>
                    <div class="attempts-dot" id="d2"></div>
                    <div class="attempts-dot" id="d3"></div>
                    <span id="attemptsText"></span>
                </div>

                @if ($errors->get('password'))
                    <script>
                        showAttempt();
                    </script>
                @endif

                <div style="margin-bottom: 24px;"></div>

                <button type="submit" class="btn-submit" id="submitBtn" disabled>
                    <span>🛡️</span>
                    <span>Confirmer et continuer</span>
                </button>
            </form>

            <div class="divider"><span>options</span></div>

            <div class="nav-links">
                <a href="{{ route('password.request') }}" class="nav-link">
                    🔓 Mot de passe oublié ?
                </a>
                <a href="{{ url()->previous() }}" class="nav-link danger">
                    ✕ Annuler
                </a>
            </div>

        </div>
    </div>

    <script>
        const passInput = document.getElementById('password');
        const toggleBtn = document.getElementById('toggleBtn');
        const submitBtn = document.getElementById('submitBtn');

        // Enable button only when something is typed
        function onType() {
            submitBtn.disabled = passInput.value.length === 0;
            submitBtn.style.opacity = passInput.value.length > 0 ? '1' : '0.5';
        }
        submitBtn.style.opacity = '0.5';

        // Password toggle
        toggleBtn.addEventListener('click', () => {
            const show = passInput.type === 'password';
            passInput.type = show ? 'text' : 'password';
            toggleBtn.textContent = show ? '🙈' : '👁';
        });

        // Attempts indicator (shown after error)
        @php $attemptErrors = $errors->get('password'); @endphp
        @if (count($errors->get('password') ?? []) > 0)
            (function() {
                const hint = document.getElementById('attemptsHint');
                const text = document.getElementById('attemptsText');
                hint.style.display = 'flex';
                document.getElementById('d1').classList.add('used');
                text.textContent = 'Mot de passe incorrect. Réessaie.';
                text.style.color = '#EF4444';
            })();
        @endif
    </script>
</body>

</html>
