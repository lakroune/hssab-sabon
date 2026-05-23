<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription · Hsab Sabon</title>
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

        .glow-1 {
            position: absolute;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.13), transparent 70%);
            border-radius: 50%;
            bottom: -60px;
            right: -80px;
            animation: blobPulse 5s ease-in-out infinite;
        }

        .glow-2 {
            position: absolute;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.07), transparent 70%);
            border-radius: 50%;
            top: 40px;
            left: -60px;
            animation: blobPulse 7s ease-in-out infinite reverse;
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

        /* coloc members visual */
        .coloc-preview {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 36px;
        }

        .coloc-member {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 14px;
            backdrop-filter: blur(4px);
            animation: memberSlide 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .coloc-member:nth-child(1) {
            animation-delay: 0.1s;
        }

        .coloc-member:nth-child(2) {
            animation-delay: 0.2s;
        }

        .coloc-member:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes memberSlide {
            from {
                opacity: 0;
                transform: translateX(-16px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .member-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .member-info {
            flex: 1;
        }

        .member-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .member-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 1px;
        }

        .member-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 99px;
        }

        .badge-paid {
            background: rgba(16, 185, 129, 0.15);
            color: #34D399;
        }

        .badge-owes {
            background: rgba(245, 166, 35, 0.15);
            color: #FBBF47;
        }

        .badge-you {
            background: rgba(245, 166, 35, 0.25);
            color: #F5A623;
            border: 1px solid rgba(245, 166, 35, 0.3);
        }

        .panel-headline {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 12px;
        }

        .panel-headline em {
            color: #F5A623;
        }

        .panel-sub {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.7;
            max-width: 320px;
        }

        /* bottom tip */
        .panel-tip {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            background: rgba(245, 166, 35, 0.08);
            border: 1px solid rgba(245, 166, 35, 0.15);
            border-radius: 12px;
        }

        .tip-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .tip-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.5;
        }

        .tip-text strong {
            color: #FBBF47;
        }

        /* -- RIGHT PANEL -- */
        .right-panel {
            flex: 1;
            background: #FDFDFC;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 40px;
            position: relative;
            overflow-y: auto;
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
            padding: 12px 0;
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
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #999;
            margin-bottom: 30px;
        }

        /* steps indicator */
        .steps {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .step-dot {
            width: 28px;
            height: 4px;
            border-radius: 99px;
            background: #ebebeb;
            transition: background 0.3s;
        }

        .step-dot.active {
            background: #F5A623;
        }

        .step-dot.done {
            background: rgba(245, 166, 35, 0.4);
        }

        .steps-label {
            font-size: 11px;
            color: #ccc;
            margin-left: 4px;
        }

        /* fields */
        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #1b1b18;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .field label .lbl-icon {
            font-size: 13px;
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
            color: #c8c5c0;
        }

        .field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
        }

        .field input.valid {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.08);
        }

        .field input.invalid {
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            font-size: 0;
            line-height: 0;
        }

        .pass-toggle:hover {
            color: #F5A623;
        }

        .pass-toggle svg {
            display: block;
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* password strength */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 7px;
        }

        .strength-segment {
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

        /* confirm match indicator */
        .match-hint {
            font-size: 11px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: opacity 0.2s;
        }

        .match-ok {
            color: #10B981;
        }

        .match-fail {
            color: #EF4444;
        }

        /* two col grid for name + email on wider screens */
        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        @media (max-width: 600px) {
            .field-grid {
                grid-template-columns: 1fr;
            }
        }

        /* terms */
        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 18px 0;
        }

        .terms-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            accent-color: #F5A623;
            margin-top: 2px;
            cursor: pointer;
        }

        .terms-row span {
            font-size: 12px;
            color: #999;
            line-height: 1.5;
        }

        .terms-row a {
            color: #1b1b18;
            font-weight: 600;
            text-decoration: none;
        }

        .terms-row a:hover {
            color: #F5A623;
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

        .login-row {
            text-align: center;
        }

        .login-row p {
            font-size: 13px;
            color: #999;
        }

        .login-row a {
            font-weight: 700;
            color: #1b1b18;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-row a:hover {
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

        .mobile-brand {
            display: none;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        @media (max-width: 900px) {
            .mobile-brand {
                display: flex;
            }

            .right-panel {
                padding: 36px 24px;
                align-items: flex-start;
                padding-top: 48px;
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

        <div class="panel-brand">
            <div class="panel-brand-icon">HS</div>
            <span class="panel-brand-name">Hsab Sabon</span>
        </div>

        <div class="panel-content">
            <h2 class="panel-headline">
                Ta coloc,<br>
                <em>organisée</em><br>
                dès aujourd'hui.
            </h2>
            <p class="panel-sub" style="margin-bottom:28px;">
                Rejoins des centaines de colocs marocains qui gèrent
                leurs dépenses sans stress.
            </p>

            <!-- Coloc members preview -->
            <div class="coloc-preview">
                <div class="coloc-member">
                    <div class="member-avatar" style="background:linear-gradient(135deg,#FBBF47,#D48A10);">YB</div>
                    <div class="member-info">
                        <div class="member-name">Youssef B.</div>
                        <div class="member-role">A payé les courses · Maarif</div>
                    </div>
                    <span class="member-badge badge-paid">+450 DH</span>
                </div>
                <div class="coloc-member">
                    <div class="member-avatar" style="background:linear-gradient(135deg,#6EE7B7,#059669);">AI</div>
                    <div class="member-info">
                        <div class="member-name">Amina I.</div>
                        <div class="member-role">Facture Redal · Agdal</div>
                    </div>
                    <span class="member-badge badge-owes">doit 150 DH</span>
                </div>
                <div class="coloc-member" style="border-color:rgba(245,166,35,0.15);background:rgba(245,166,35,0.04);">
                    <div class="member-avatar" style="background:rgba(245,166,35,0.2);color:#F5A623;font-size:18px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-sparkles">
                            <path
                                d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                            <path d="M5 3v4" />
                            <path d="M19 17v4" />
                            <path d="M3 5h4" />
                            <path d="M17 19h4" />
                        </svg>
                    </div>
                    <div class="member-info">
                        <div class="member-name" style="color:rgba(255,255,255,0.5);">Toi, bientôt...</div>
                        <div class="member-role">Rejoins ta coloc</div>
                    </div>
                    <span class="member-badge badge-you">Nouveau</span>
                </div>
            </div>
        </div>

        <div class="panel-tip">
            <span class="tip-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-lightbulb">
                    <path
                        d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5" />
                    <path d="M9 18h6" />
                    <path d="M10 22h4" />
                </svg></span>
            <span class="tip-text">
                <strong>100% gratuit</strong> pendant la BETA.<br>
                Inscription en moins de 30 secondes.
            </span>
        </div>
    </div>

    <!-- ============ RIGHT PANEL ============ -->
    <div class="right-panel">
        <div class="form-box">

            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <p class="form-eyebrow">Créer un compte</p>
            <h1 class="form-title">Rejoins ta coloc <svg xmlns="http://www.w3.org/2000/svg" width="28"
                    height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                    <path
                        d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg></h1>
            <p class="form-subtitle">Gratuit — aucune carte bancaire requise.</p>

            <!-- Steps indicator -->
            <div class="steps">
                <div class="step-dot active" id="step1"></div>
                <div class="step-dot" id="step2"></div>
                <div class="step-dot" id="step3"></div>
                <span class="steps-label" id="stepsLabel">Informations personnelles</span>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name + Email -->
                <div class="field-grid">
                    <div class="field">
                        <label for="name">
                            <span class="lbl-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                    height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-user">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg></span> Prénom & Nom
                        </label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                    height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-sparkles">
                                    <path
                                        d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                    <path d="M5 3v4" />
                                    <path d="M19 17v4" />
                                    <path d="M3 5h4" />
                                    <path d="M17 19h4" />
                                </svg></span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Youssef B." required autofocus autocomplete="name" />
                        </div>
                        @error('name')
                            <p class="field-error"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">
                            <span class="lbl-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                    height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-mail">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                </svg></span> Email
                        </label>
                        <div class="input-wrap">
                            <span class="input-icon">@</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="ton@email.com" required autocomplete="username" />
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
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password">
                        <span class="lbl-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg></span> Mot de passe
                    </label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="15"
                                height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-key-round">
                                <path
                                    d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z" />
                                <circle cx="16.5" cy="7.5" r=".5" fill="currentColor" />
                            </svg></span>
                        <input id="password" type="password" name="password" placeholder="Min. 8 caractères"
                            required autocomplete="new-password" oninput="checkStrength(this.value)" />
                        <button type="button" class="pass-toggle" onclick="togglePass('password', this)"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></button>
                    </div>
                    <!-- Strength bar -->
                    <div class="strength-bar" id="strengthBar">
                        <div class="strength-segment" id="s1"></div>
                        <div class="strength-segment" id="s2"></div>
                        <div class="strength-segment" id="s3"></div>
                        <div class="strength-segment" id="s4"></div>
                    </div>
                    <div class="strength-label" id="strengthLabel"></div>
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

                <!-- Confirm Password -->
                <div class="field">
                    <label for="password_confirmation">
                        <span class="lbl-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m9 12 2 2 4-4" />
                            </svg></span> Confirmer le mot de passe
                    </label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="15"
                                height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-key-round">
                                <path
                                    d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z" />
                                <circle cx="16.5" cy="7.5" r=".5" fill="currentColor" />
                            </svg></span>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Répète ton mot de passe" required autocomplete="new-password"
                            oninput="checkMatch()" />
                        <button type="button" class="pass-toggle"
                            onclick="togglePass('password_confirmation', this)"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></button>
                    </div>
                    <div class="match-hint" id="matchHint" style="opacity:0;">
                        <span id="matchIcon"></span>
                        <span id="matchText"></span>
                    </div>
                    @error('password_confirmation')
                        <p class="field-error"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="terms-row">
                    <input type="checkbox" id="terms" required>
                    <span>
                        J'accepte les <a href="#">Conditions d'utilisation</a> et la
                        <a href="#">Politique de confidentialité</a> de Hsab Sabon.
                    </span>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <span>Créer mon compte</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </button>
            </form>

            <div class="divider"><span>déjà inscrit·e ?</span></div>

            <div class="login-row">
                <p>
                    <a href="{{ route('login') }}"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                            height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left" style="vertical-align:middle;margin-right:4px;">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg> Se connecter à mon compte</a>
                </p>
            </div>

        </div>
    </div>

    <script>
        // -- Password toggle --
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            // Use innerHTML to render SVG, NOT textContent
            btn.innerHTML = show ?
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>' :
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>';
        }

        // -- Password strength --
        function checkStrength(val) {
            const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'),
                document.getElementById('s4')
            ];
            const label = document.getElementById('strengthLabel');
            const step2 = document.getElementById('step2');

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const colors = ['#EF4444', '#F59E0B', '#10B981', '#059669'];
            const labelTexts = ['Trop court', 'Moyen', 'Bien', 'Excellent'];
            const labelIcons = [
                '',
                '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-meh" style="display:inline-block;vertical-align:middle;margin-left:4px;"><circle cx="12" cy="12" r="10"/><line x1="8" x2="16" y1="15" y2="15"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up" style="display:inline-block;vertical-align:middle;margin-left:4px;"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-biceps-flexed" style="display:inline-block;vertical-align:middle;margin-left:4px;"><path d="M12.409 13.017A5 5 0 0 1 15 8c1.866 0 3 .5 4 2"/><path d="M18.599 6.764A9.956 9.956 0 0 1 22 12c0 2.411-.61 4.68-1.682 6.664"/><path d="M15 22a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M11 22a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M7 22a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M4 22a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M3 18c0-1.326.527-2.574 1.463-3.5"/><path d="M7 13.535V11a5 5 0 0 1 5-5 3 3 0 0 1 3 3v1.171a3 3 0 0 1-.879 2.122L12 14.5"/></svg>'
            ];

            segs.forEach((s, i) => {
                s.style.background = i < score ? colors[score - 1] : '#ebebeb';
            });

            if (val.length === 0) {
                label.innerHTML = '';
                step2.classList.remove('active', 'done');
            } else {
                label.innerHTML = (labelTexts[score - 1] || '') + (labelIcons[score - 1] || '');
                label.style.color = colors[score - 1] || '#bbb';
                step2.classList.add('active');
                if (score >= 3) step2.classList.add('done');
            }
        }

        // -- Password match --
        function checkMatch() {
            const pass = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;
            const hint = document.getElementById('matchHint');
            const icon = document.getElementById('matchIcon');
            const text = document.getElementById('matchText');
            const step3 = document.getElementById('step3');

            if (!conf) {
                hint.style.opacity = '0';
                return;
            }
            hint.style.opacity = '1';

            if (pass === conf) {
                hint.className = 'match-hint match-ok';
                icon.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check" style="display:inline-block;vertical-align:middle;"><path d="M20 6 9 17l-5-5"/></svg>';
                text.textContent = 'Les mots de passe correspondent';
                step3.classList.add('active', 'done');
            } else {
                hint.className = 'match-hint match-fail';
                icon.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x" style="display:inline-block;vertical-align:middle;"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
                text.textContent = 'Ne correspond pas';
                step3.classList.remove('done');
                step3.classList.add('active');
            }
        }

        // -- Step indicator on field focus --
        document.getElementById('name').addEventListener('focus', () => {
            document.getElementById('stepsLabel').textContent = 'Informations personnelles';
        });
        document.getElementById('password').addEventListener('focus', () => {
            document.getElementById('stepsLabel').textContent = 'Sécurité du compte';
            document.getElementById('step2').classList.add('active');
        });
        document.getElementById('password_confirmation').addEventListener('focus', () => {
            document.getElementById('stepsLabel').textContent = 'Confirmation';
            document.getElementById('step3').classList.add('active');
        });
    </script>
</body>

</html>
