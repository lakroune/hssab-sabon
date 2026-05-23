<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau mot de passe · Hsab Sabon</title>
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
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.12), transparent 70%);
            bottom: -60px;
            right: -60px;
        }

        .glow-2 {
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.06), transparent 70%);
            top: 40px;
            left: -50px;
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

        /* key visual */
        .key-visual {
            position: relative;
            width: 110px;
            margin-bottom: 36px;
        }

        .key-ring-outer {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: ringBreath 3s ease-in-out infinite;
        }

        .key-ring-inner {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: rgba(245, 166, 35, 0.07);
            border: 1px solid rgba(245, 166, 35, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes ringBreath {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(245, 166, 35, 0);
            }

            50% {
                box-shadow: 0 0 0 12px rgba(245, 166, 35, 0.05);
            }
        }

        /* rotating orbit dot */
        .orbit {
            position: absolute;
            inset: 0;
            animation: orbitSpin 4s linear infinite;
        }

        .orbit-dot {
            position: absolute;
            top: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 7px;
            height: 7px;
            background: #F5A623;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(245, 166, 35, 0.6);
        }

        @keyframes orbitSpin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
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

        /* password tips */
        .tip-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .tip-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.3);
        }

        .tip-icon {
            width: 26px;
            height: 26px;
            flex-shrink: 0;
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .panel-bottom {
            position: relative;
            z-index: 2;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.25);
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #F5A623;
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
            max-width: 420px;
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

        /* fields */
        .field {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #1b1b18;
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
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap:focus-within .input-icon {
            color: #F5A623;
        }

        .field input {
            width: 100%;
            padding: 13px 44px 13px 42px;
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
            color: #c8c5c0;
        }

        .field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.11);
        }

        .field input.is-valid {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.08);
        }

        .field input.is-invalid {
            border-color: #EF4444;
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
            transition: color 0.2s;
            padding: 4px;
        }

        .pass-toggle:hover {
            color: #F5A623;
        }

        /* strength bar */
        .strength-wrap {
            margin-top: 8px;
        }

        .strength-bar {
            display: flex;
            gap: 4px;
        }

        .strength-seg {
            flex: 1;
            height: 3px;
            border-radius: 99px;
            background: #ebebeb;
            transition: background 0.3s;
        }

        .strength-label {
            font-size: 11px;
            color: #bbb;
            margin-top: 4px;
        }

        /* match hint */
        .match-hint {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            margin-top: 6px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .match-hint.visible {
            opacity: 1;
        }

        .match-ok {
            color: #10B981;
        }

        .match-fail {
            color: #EF4444;
        }

        /* email readonly chip */
        .email-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 14px;
            background: #F8F8F6;
            border: 1.5px solid #e8e8e4;
            border-radius: 12px;
            font-size: 13px;
            color: #888;
        }

        .email-chip svg {
            flex-shrink: 0;
            color: #ccc;
        }

        .email-chip span {
            font-weight: 500;
        }

        .email-chip .lock-tag {
            margin-left: auto;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #bbb;
            background: #ebebeb;
            padding: 2px 7px;
            border-radius: 99px;
        }

        .field-error {
            font-size: 12px;
            color: #EF4444;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
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
            margin-top: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245, 166, 35, 0.45);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-size: 12px;
            color: #bbb;
            text-decoration: none;
            margin-top: 18px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .login-link:hover {
            color: #1b1b18;
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
            <!-- Key visual -->
            <div class="key-visual">
                <div class="key-ring-outer">
                    <div class="key-ring-inner">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </div>
                </div>
                <div class="orbit">
                    <div class="orbit-dot"></div>
                </div>
            </div>

            <h2 class="panel-headline">
                Nouveau<br>
                mot de<br>
                <em>passe.</em>
            </h2>
            <p class="panel-sub">
                Choisis un mot de passe fort pour sécuriser
                l'accès à ta coloc et tes finances partagées.
            </p>

            <!-- Tips -->
            <div class="tip-list">
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(245,166,35,0.6)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    Minimum 8 caractères
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(245,166,35,0.6)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    Au moins une majuscule & un chiffre
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(245,166,35,0.6)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    Un caractère spécial pour plus de sécurité
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(255,255,255,0.15)" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </div>
                    Evite d'utiliser ton prénom ou ta date de naissance
                </div>
            </div>
        </div>

        <div class="panel-bottom">
            <a href="{{ route('login') }}" class="back-link">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Retour à la connexion
            </a>
        </div>
    </div>

    <!-- ════════════ RIGHT PANEL ════════════ -->
    <div class="right-panel">
        <div class="form-box">

            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <p class="form-eyebrow">Réinitialisation</p>
            <h1 class="form-title">Nouveau<br>mot de passe</h1>
            <p class="form-desc">
                Choisis un mot de passe sécurisé pour ton compte Hsab Sabon.
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email (readonly display) -->
                <div class="field">
                    <label class="field-label">Adresse email</label>
                    <div class="email-chip">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <span>{{ old('email', $request->email) }}</span>
                        <span class="lock-tag">Vérifié</span>
                    </div>
                    <input type="hidden" name="email" value="{{ old('email', $request->email) }}">
                    @error('email')
                        <p class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- New password -->
                <div class="field">
                    <label class="field-label" for="password">Nouveau mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" placeholder="Min. 8 caractères"
                            required autocomplete="new-password" oninput="checkStrength(this.value)" />
                        <button type="button" class="pass-toggle" onclick="togglePass('password', this)">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" id="eye1">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    <!-- Strength -->
                    <div class="strength-wrap">
                        <div class="strength-bar">
                            <div class="strength-seg" id="seg1"></div>
                            <div class="strength-seg" id="seg2"></div>
                            <div class="strength-seg" id="seg3"></div>
                            <div class="strength-seg" id="seg4"></div>
                        </div>
                        <div class="strength-label" id="strengthLabel"></div>
                    </div>
                    @error('password')
                        <p class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm password -->
                <div class="field">
                    <label class="field-label" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Répète ton mot de passe" required autocomplete="new-password"
                            oninput="checkMatch()" />
                        <button type="button" class="pass-toggle"
                            onclick="togglePass('password_confirmation', this)">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    <div class="match-hint" id="matchHint">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" id="matchIcon">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        <span id="matchText"></span>
                    </div>
                    @error('password_confirmation')
                        <p class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Réinitialiser le mot de passe
                </button>
            </form>

            <a href="{{ route('login') }}" class="login-link">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Retour à la connexion
            </a>

        </div>
    </div>

    <script>
        // ── Toggle visibility ──
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.innerHTML = isHidden ?
                `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>` :
                `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
        }

        // ── Strength ──
        function checkStrength(val) {
            const segs = [1, 2, 3, 4].map(i => document.getElementById('seg' + i));
            const label = document.getElementById('strengthLabel');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const palette = ['#EF4444', '#F59E0B', '#10B981', '#059669'];
            const labels = ['Trop court', 'Moyen', 'Bien', 'Excellent'];
            segs.forEach((s, i) => {
                s.style.background = i < score ? palette[score - 1] : '#ebebeb';
            });
            label.textContent = val.length ? labels[score - 1] || '' : '';
            label.style.color = val.length ? palette[score - 1] : '#bbb';
            checkMatch();
        }

        // ── Match ──
        function checkMatch() {
            const pass = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;
            const hint = document.getElementById('matchHint');
            const icon = document.getElementById('matchIcon');
            const text = document.getElementById('matchText');
            const confInput = document.getElementById('password_confirmation');

            if (!conf) {
                hint.classList.remove('visible');
                return;
            }
            hint.classList.add('visible');

            const ok = pass === conf;
            hint.className = 'match-hint visible ' + (ok ? 'match-ok' : 'match-fail');
            icon.innerHTML = ok ?
                '<polyline points="20 6 9 17 4 12"/>' :
                '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>';
            text.textContent = ok ? 'Les mots de passe correspondent' : 'Ne correspond pas';
            confInput.classList.toggle('is-valid', ok);
            confInput.classList.toggle('is-invalid', !ok);
        }
    </script>
</body>

</html>
