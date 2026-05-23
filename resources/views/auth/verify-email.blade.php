<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vérification email · Hsab Sabon</title>
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
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.11), transparent 70%);
            top: -40px;
            right: -60px;
        }

        .glow-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.06), transparent 70%);
            bottom: 80px;
            left: -40px;
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

        /* envelope animation */
        .envelope-wrap {
            width: 110px;
            margin-bottom: 36px;
            position: relative;
        }

        .envelope-outer {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: envelopePulse 2.8s ease-in-out infinite;
        }

        .envelope-inner {
            width: 68px;
            height: 68px;
            background: rgba(245, 166, 35, 0.08);
            border: 1px solid rgba(245, 166, 35, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes envelopePulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(245, 166, 35, 0);
            }

            50% {
                box-shadow: 0 0 0 14px rgba(245, 166, 35, 0.05);
            }
        }

        /* flying dots */
        .dot-fly {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #F5A623;
            border-radius: 50%;
            animation: dotFly 2.4s ease-in-out infinite;
            opacity: 0;
        }

        .dot-fly:nth-child(1) {
            top: 10px;
            right: 10px;
            animation-delay: 0s;
        }

        .dot-fly:nth-child(2) {
            top: 20px;
            right: -4px;
            animation-delay: 0.4s;
        }

        .dot-fly:nth-child(3) {
            top: 4px;
            right: 24px;
            animation-delay: 0.8s;
        }

        @keyframes dotFly {
            0% {
                opacity: 0;
                transform: translate(0, 0) scale(0.5);
            }

            30% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translate(12px, -18px) scale(1.2);
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

        /* checklist */
        .check-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
        }

        .check-circle {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .check-circle.done {
            background: rgba(245, 166, 35, 0.15);
            border: 1px solid rgba(245, 166, 35, 0.25);
        }

        .check-circle.pending {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* user hint bottom */
        .user-hint {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 13px;
        }

        .user-av {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            color: white;
        }

        .user-email {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
            margin-bottom: 1px;
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

        /* inbox illustration */
        .inbox-card {
            background: white;
            border: 1.5px solid #f0f0ec;
            border-radius: 16px;
            padding: 18px 20px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .inbox-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #F5A623, #FBBF47);
        }

        .inbox-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .inbox-icon-wrap {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inbox-subject {
            font-size: 13px;
            font-weight: 700;
            color: #1b1b18;
        }

        .inbox-from {
            font-size: 11px;
            color: #bbb;
            margin-top: 2px;
        }

        .inbox-dot {
            width: 8px;
            height: 8px;
            background: #F5A623;
            border-radius: 50%;
            flex-shrink: 0;
            margin-left: auto;
            animation: dotBlink 1.6s ease-in-out infinite;
        }

        @keyframes dotBlink {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.3;
                transform: scale(0.7);
            }
        }

        /* success banner */
        .success-banner {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 16px;
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            border-radius: 12px;
            margin-bottom: 24px;
            animation: formSlideIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .success-banner svg {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .success-banner-text {
            font-size: 13px;
            color: #065F46;
            line-height: 1.5;
        }

        /* spam hint */
        .spam-hint {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 11px 14px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 11px;
            margin-bottom: 24px;
        }

        .spam-hint-text {
            font-size: 12px;
            color: #92400E;
            line-height: 1.5;
        }

        .spam-hint-text strong {
            color: #78350F;
        }

        /* countdown */
        .resend-hint {
            font-size: 12px;
            color: #bbb;
            margin-top: 10px;
            text-align: center;
        }

        .resend-hint span {
            color: #F5A623;
            font-weight: 700;
        }

        .btn-primary {
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245, 166, 35, 0.45);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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

        .logout-btn {
            width: 100%;
            padding: 13px;
            background: transparent;
            color: #bbb;
            font-weight: 600;
            font-size: 13px;
            border: 1.5px solid #ebebeb;
            border-radius: 12px;
            cursor: pointer;
            font-family: 'Instrument Sans', sans-serif;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .logout-btn:hover {
            border-color: #EF4444;
            color: #EF4444;
            background: #FFF5F5;
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
            <!-- Envelope visual -->
            <div class="envelope-wrap">
                <div class="envelope-outer">
                    <div class="envelope-inner">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="1.5">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                </div>
                <div class="dot-fly"></div>
                <div class="dot-fly"></div>
                <div class="dot-fly"></div>
            </div>

            <h2 class="panel-headline">
                Vérifie<br>ton <em>email</em><br>pour continuer.
            </h2>
            <p class="panel-sub">
                Une dernière étape avant de rejoindre ta coloc.
                Le lien n'expire pas tant que tu ne le demandes pas.
            </p>

            <!-- Steps checklist -->
            <div class="check-list">
                <div class="check-item">
                    <div class="check-circle done">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <span style="color:rgba(255,255,255,0.55);">Compte créé avec succès</span>
                </div>
                <div class="check-item">
                    <div class="check-circle done">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <span style="color:rgba(255,255,255,0.55);">Email de vérification envoyé</span>
                </div>
                <div class="check-item">
                    <div class="check-circle pending">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(255,255,255,0.2)" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                    </div>
                    <span>Cliquer sur le lien dans l'email</span>
                </div>
                <div class="check-item">
                    <div class="check-circle pending">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(255,255,255,0.2)" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                    </div>
                    <span>Rejoindre ta coloc</span>
                </div>
            </div>
        </div>

        <!-- Logged-in user -->
        <div class="user-hint">
            <div class="user-av">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name ?? 'Utilisateur' }}</div>
                <div class="user-email">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>
    </div>

    <!-- ════════════ RIGHT PANEL ════════════ -->
    <div class="right-panel">
        <div class="form-box">

            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <p class="form-eyebrow">Étape finale</p>
            <h1 class="form-title">Confirme ton<br>adresse email</h1>
            <p class="form-desc">
                On a envoyé un lien de vérification à
                <strong style="color:#1b1b18;">{{ auth()->user()->email ?? 'ton email' }}</strong>.
                Clique dessus pour activer ton compte.
            </p>

            <!-- Success banner -->
            @if (session('status') == 'verification-link-sent')
                <div class="success-banner">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10B981"
                        stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    <span class="success-banner-text">
                        Nouveau lien envoyé avec succès. Vérifie ta boîte de réception.
                    </span>
                </div>
            @endif

            <!-- Inbox preview card -->
            <div class="inbox-card">
                <div class="inbox-row">
                    <div class="inbox-icon-wrap">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="1.8">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <p class="inbox-subject">Confirme ton email · Hsab Sabon</p>
                        <p class="inbox-from">noreply@hsabsabon.ma</p>
                    </div>
                    <div class="inbox-dot"></div>
                </div>
            </div>

            <!-- Spam hint -->
            <div class="spam-hint">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                    stroke-width="2" style="flex-shrink:0;margin-top:1px;">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <span class="spam-hint-text">
                    Tu ne vois rien ? Vérifie ton dossier <strong>Spam</strong> ou <strong>Promotions</strong>.
                </span>
            </div>

            <!-- Resend form -->
            <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                @csrf
                <button type="submit" class="btn-primary" id="resendBtn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <polyline points="23 4 23 10 17 10" />
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                    </svg>
                    Renvoyer le lien
                </button>
                <p class="resend-hint" id="cooldownHint" style="display:none;">
                    Attends <span id="countdown">60</span>s avant de renvoyer
                </p>
            </form>

            <div class="divider"><span>ou</span></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Se déconnecter
                </button>
            </form>

        </div>
    </div>

    <script>
        // Cooldown after resend click
        const resendBtn = document.getElementById('resendBtn');
        const resendForm = document.getElementById('resendForm');
        const cooldownHint = document.getElementById('cooldownHint');
        const countdownEl = document.getElementById('countdown');

        @if (session('status') == 'verification-link-sent')
            startCooldown();
        @endif

        resendForm.addEventListener('submit', () => {
            startCooldown();
        });

        function startCooldown() {
            resendBtn.disabled = true;
            resendBtn.style.opacity = '0.5';
            cooldownHint.style.display = 'block';
            let secs = 60;
            countdownEl.textContent = secs;
            const iv = setInterval(() => {
                secs--;
                countdownEl.textContent = secs;
                if (secs <= 0) {
                    clearInterval(iv);
                    resendBtn.disabled = false;
                    resendBtn.style.opacity = '1';
                    cooldownHint.style.display = 'none';
                }
            }, 1000);
        }
    </script>
</body>

</html>
