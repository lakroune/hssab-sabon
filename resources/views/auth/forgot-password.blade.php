<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mot de passe oublié · Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

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
        @media (max-width: 900px) { .left-panel { display: none; } }

        .mosaic-bg {
            position: absolute; inset: 0;
            background-image:
                repeating-linear-gradient(60deg,  rgba(245,166,35,0.06) 0, rgba(245,166,35,0.06) 1px, transparent 1px, transparent 44px),
                repeating-linear-gradient(-60deg, rgba(245,166,35,0.06) 0, rgba(245,166,35,0.06) 1px, transparent 1px, transparent 44px),
                repeating-linear-gradient(0deg,   rgba(245,166,35,0.03) 0, rgba(245,166,35,0.03) 1px, transparent 1px, transparent 44px);
            animation: mosaicDrift 12s linear infinite;
        }
        @keyframes mosaicDrift {
            0%   { background-position: 0 0, 0 0, 0 0; }
            100% { background-position: 88px 88px, -88px 88px, 0 44px; }
        }
        .glow-blob {
            position: absolute;
            border-radius: 50%;
            animation: blobPulse 5s ease-in-out infinite;
        }
        .glow-1 {
            width: 360px; height: 360px;
            background: radial-gradient(circle, rgba(245,166,35,0.12), transparent 70%);
            top: -60px; right: -80px;
        }
        .glow-2 {
            width: 240px; height: 240px;
            background: radial-gradient(circle, rgba(245,166,35,0.07), transparent 70%);
            bottom: 60px; left: -50px;
            animation-duration: 7s; animation-direction: reverse;
        }
        @keyframes blobPulse {
            0%,100% { transform: scale(1); opacity: 1; }
            50%      { transform: scale(1.12); opacity: 0.7; }
        }

        .panel-brand {
            position: relative; z-index: 2;
            display: flex; align-items: center; gap: 10px;
        }
        .panel-brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; color: white;
            box-shadow: 0 8px 20px rgba(245,166,35,0.4);
        }
        .panel-brand-name {
            font-size: 16px; font-weight: 700; color: white; letter-spacing: -0.02em;
        }

        .panel-content {
            position: relative; z-index: 2;
            flex: 1;
            display: flex; flex-direction: column; justify-content: center;
        }

        /* Lock visual */
        .lock-visual {
            position: relative;
            width: 100px;
            margin-bottom: 36px;
        }
        .lock-icon {
            width: 90px; height: 90px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            font-size: 38px;
            animation: lockShake 4s ease-in-out infinite;
        }
        @keyframes lockShake {
            0%,90%,100% { transform: rotate(0deg); }
            92%  { transform: rotate(-6deg); }
            96%  { transform: rotate(6deg); }
            98%  { transform: rotate(-3deg); }
        }
        .lock-badge {
            position: absolute;
            bottom: -6px; right: -6px;
            width: 30px; height: 30px;
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(245,166,35,0.5);
            animation: badgePop 0.5s cubic-bezier(0.34,1.56,0.64,1) 0.3s both;
        }
        @keyframes badgePop {
            from { transform: scale(0); }
            to   { transform: scale(1); }
        }

        .panel-headline {
            font-family: 'Playfair Display', serif;
            font-size: 40px; font-weight: 900;
            color: white; line-height: 1.1; margin-bottom: 14px;
        }
        .panel-headline em { color: #F5A623; }
        .panel-sub {
            font-size: 14px; color: rgba(255,255,255,0.4);
            line-height: 1.7; max-width: 300px;
        }

        /* steps */
        .reset-steps {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-top: 36px;
        }
        .reset-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding-bottom: 24px;
            position: relative;
        }
        .reset-step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 15px;
            top: 32px;
            bottom: 0;
            width: 1px;
            background: rgba(255,255,255,0.06);
        }
        .step-circle {
            width: 32px; height: 32px; flex-shrink: 0;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
        }
        .step-circle.active {
            background: linear-gradient(135deg, #FBBF47, #D48A10);
            color: #1b1b18;
            box-shadow: 0 4px 12px rgba(245,166,35,0.35);
        }
        .step-circle.dim {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.2);
        }
        .step-txt { padding-top: 4px; }
        .step-title { font-size: 13px; font-weight: 600; color: white; margin-bottom: 2px; }
        .step-title.dim { color: rgba(255,255,255,0.2); }
        .step-desc { font-size: 11px; color: rgba(255,255,255,0.3); }

        /* bottom back link */
        .panel-back {
            position: relative; z-index: 2;
        }
        .panel-back a {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 13px; color: rgba(255,255,255,0.3);
            text-decoration: none;
            transition: color 0.2s;
        }
        .panel-back a:hover { color: #F5A623; }

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
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #F5A623, #FBBF47, #F5A623);
            background-size: 200% 100%;
            animation: stripeShimmer 2s linear infinite;
        }
        @keyframes stripeShimmer {
            0%   { background-position: 0% 0; }
            100% { background-position: 200% 0; }
        }

        .form-box {
            width: 100%; max-width: 400px;
            animation: formSlideIn 0.6s cubic-bezier(0.22,1,0.36,1) both;
        }
        @keyframes formSlideIn {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* success state */
        .form-box.sent .form-main  { display: none; }
        .form-box.sent .form-sent  { display: flex; }
        .form-sent {
            display: none;
            flex-direction: column;
            align-items: center;
            text-align: center;
            animation: formSlideIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
        }
        .sent-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 34px;
            margin-bottom: 24px;
            animation: sentPop 0.5s cubic-bezier(0.34,1.56,0.64,1) 0.1s both;
        }
        @keyframes sentPop {
            from { transform: scale(0) rotate(-20deg); }
            to   { transform: scale(1) rotate(0deg); }
        }

        .form-eyebrow {
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.2em;
            color: #F5A623; margin-bottom: 8px;
        }
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 900;
            color: #1b1b18; line-height: 1.1; margin-bottom: 8px;
        }
        .form-desc {
            font-size: 14px; color: #999;
            line-height: 1.7; margin-bottom: 32px;
        }
        .form-desc strong { color: #1b1b18; }

        /* email input */
        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 11px; font-weight: 700;
            color: #1b1b18; letter-spacing: 0.07em;
            text-transform: uppercase; margin-bottom: 7px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px; top: 50%; transform: translateY(-50%);
            color: #d0cdc8; font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }
        .input-wrap:focus-within .input-icon { color: #F5A623; }
        .field input {
            width: 100%;
            padding: 14px 14px 14px 42px;
            background: white;
            border: 1.5px solid #e8e8e4;
            border-radius: 12px;
            font-size: 15px; color: #1b1b18;
            font-family: 'Instrument Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field input::placeholder { color: #c8c5c0; }
        .field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245,166,35,0.12);
        }
        .field-error {
            font-size: 12px; color: #EF4444;
            margin-top: 5px; display: flex; align-items: center; gap: 4px;
        }

        /* info box */
        .info-box {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 14px 16px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            margin-bottom: 24px;
        }
        .info-box-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
        .info-box-text { font-size: 12px; color: #92400E; line-height: 1.6; }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            color: #1b1b18;
            font-weight: 800; font-size: 15px;
            border: none; border-radius: 12px;
            cursor: pointer;
            font-family: 'Instrument Sans', sans-serif;
            box-shadow: 0 8px 24px rgba(245,166,35,0.35);
            transition: all 0.2s ease;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245,166,35,0.45);
        }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled {
            opacity: 0.6; cursor: not-allowed; transform: none;
        }

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 22px 0;
        }
        .divider::before,.divider::after { content:'';flex:1;height:1px;background:#ebebeb; }
        .divider span { font-size: 12px; color: #ccc; }

        .back-link {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: #888;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: #1b1b18; }

        /* session status */
        .session-status {
            background: #ECFDF5; border: 1px solid #A7F3D0;
            border-radius: 10px; padding: 12px 16px;
            font-size: 13px; color: #065F46;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        .mobile-brand {
            display: none;
            align-items: center; gap: 8px; margin-bottom: 32px;
        }
        @media (max-width: 900px) {
            .mobile-brand { display: flex; }
            .right-panel { padding: 48px 24px; }
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
            <div class="lock-visual">
                <div class="lock-icon">🔐</div>
                <div class="lock-badge">✉</div>
            </div>

            <h2 class="panel-headline">
                On t'a<br>
                <em>couvert</em>,<br>
                pas de stress.
            </h2>
            <p class="panel-sub">
                Ça arrive à tout le monde. Un email et tu retrouves
                l'accès à ta coloc en 2 minutes.
            </p>

            <!-- Reset steps -->
            <div class="reset-steps">
                <div class="reset-step">
                    <div class="step-circle active">1</div>
                    <div class="step-txt">
                        <div class="step-title">Entre ton email</div>
                        <div class="step-desc">Celui utilisé lors de l'inscription</div>
                    </div>
                </div>
                <div class="reset-step">
                    <div class="step-circle dim">2</div>
                    <div class="step-txt">
                        <div class="step-title dim">Consulte ta boîte mail</div>
                        <div class="step-desc">Lien valable 60 minutes</div>
                    </div>
                </div>
                <div class="reset-step">
                    <div class="step-circle dim">3</div>
                    <div class="step-txt">
                        <div class="step-title dim">Choisis un nouveau mot de passe</div>
                        <div class="step-desc">Et retrouve ta coloc</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-back">
            <a href="{{ route('login') }}">← Retour à la connexion</a>
        </div>
    </div>

    <!-- ════════════ RIGHT PANEL ════════════ -->
    <div class="right-panel">
        <div class="form-box" id="formBox">

            <!-- Mobile brand -->
            <div class="mobile-brand">
                <div class="panel-brand-icon" style="width:34px;height:34px;font-size:12px;border-radius:10px;">HS</div>
                <span style="font-weight:700;font-size:15px;color:#1b1b18;">Hsab Sabon</span>
            </div>

            <!-- ── MAIN FORM ── -->
            <div class="form-main">
                <p class="form-eyebrow">Récupération</p>
                <h1 class="form-title">Mot de passe<br>oublié ?</h1>
                <p class="form-desc">
                    Pas de panique. Saisis ton email et on t'envoie un lien
                    pour <strong>réinitialiser ton mot de passe</strong>.
                </p>

                @if (session('status'))
                    <div class="session-status">
                        <span>✅</span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <div class="info-box">
                    <span class="info-box-icon">💡</span>
                    <span class="info-box-text">
                        Vérifie aussi ton dossier <strong>Spam</strong> si tu ne reçois rien dans 2 minutes.
                    </span>
                </div>

                <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                    @csrf

                    <div class="field">
                        <label for="email">Adresse email</label>
                        <div class="input-wrap">
                            <span class="input-icon">✉</span>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="ton@email.com"
                                   required autofocus />
                        </div>
                        @error('email')
                            <p class="field-error">⚠ {{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Envoyer le lien de réinitialisation</span>
                        <span>→</span>
                    </button>
                </form>

                <div class="divider"><span>ou</span></div>

                <a href="{{ route('login') }}" class="back-link">
                    ← Retour à la connexion
                </a>
            </div>

            <!-- ── SUCCESS STATE ── -->
            <div class="form-sent" id="sentState">
                <div class="sent-icon">📬</div>
                <p class="form-eyebrow" style="margin-bottom:8px;">Email envoyé !</p>
                <h2 class="form-title" style="margin-bottom:12px;">Vérifie ta boîte</h2>
                <p style="font-size:14px;color:#999;line-height:1.7;margin-bottom:28px;">
                    On a envoyé un lien à <strong id="sentEmail" style="color:#1b1b18;"></strong>.
                    Le lien expire dans <strong style="color:#F5A623;">60 minutes</strong>.
                </p>
                <a href="{{ route('login') }}" class="btn-submit" style="text-decoration:none;justify-content:center;">
                    ← Retour à la connexion
                </a>
                <button type="button" onclick="resend()"
                        style="margin-top:14px;background:none;border:none;font-size:13px;color:#bbb;cursor:pointer;font-family:inherit;transition:color 0.2s;"
                        onmouseover="this.style.color='#F5A623'" onmouseout="this.style.color='#bbb'">
                    Renvoyer le lien
                </button>
            </div>

        </div>
    </div>

    <script>
        const form     = document.getElementById('resetForm');
        const btn      = document.getElementById('submitBtn');
        const formBox  = document.getElementById('formBox');
        const sentEmail = document.getElementById('sentEmail');

        if (form) {
            form.addEventListener('submit', function(e) {
                const emailVal = document.getElementById('email').value;
                btn.disabled = true;
                btn.innerHTML = '<span style="opacity:0.6">Envoi en cours...</span>';

                // show success UI after submit (Laravel handles the actual POST)
                // We let the form submit normally; the success state shows
                // only if Laravel redirects back with session('status').
                // Optionally show optimistic UI:
                sentEmail.textContent = emailVal;
                setTimeout(() => {
                    if (!form.dataset.submitted) {
                        form.dataset.submitted = 'true';
                        form.submit();
                    }
                }, 100);
            });
        }

        // If Laravel returned with status, show success panel
        @if(session('status'))
            formBox.classList.add('sent');
            document.getElementById('sentEmail').textContent = '{{ old("email") }}';
        @endif

        function resend() {
            formBox.classList.remove('sent');
            btn.disabled = false;
            btn.innerHTML = '<span>Envoyer le lien de réinitialisation</span><span>→</span>';
        }
    </script>
</body>
</html>