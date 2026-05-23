<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>419 — Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --amber: #F5A623;
            --amber-light: #FBBF47;
            --dark: #1b1b18;
            --violet: #8B5CF6;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #FDFDFC;
        }

        .clock-tick {
            animation: tick 2s ease-in-out infinite;
        }

        @keyframes tick {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(15deg);
            }

            75% {
                transform: rotate(-15deg);
            }
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: var(--amber);
            color: var(--dark);
            font-weight: 700;
            border-radius: 14px;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 8px 30px rgba(245, 166, 35, 0.35);
        }

        .btn-primary:hover {
            background: var(--amber-light);
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(245, 166, 35, 0.45);
        }

        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: clamp(120px, 15vw, 200px);
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, var(--violet), #A78BFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0.12;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }

        [data-reveal] {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        }

        [data-reveal].visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <div
        style="position:absolute;inset:0;background-image:
        radial-gradient(circle at 40% 60%, rgba(139,92,246,0.05) 0%, transparent 50%),
        radial-gradient(circle at 60% 40%, rgba(245,166,35,0.04) 0%, transparent 40%);
        pointer-events:none;">
    </div>

    <div class="relative z-10 text-center px-6 max-w-lg" data-reveal>
        <!-- Clock icon -->
        <div class="clock-tick" style="margin-bottom: 24px;">
            <div
                style="width:72px;height:72px;background:linear-gradient(135deg,#EDE9FE,#DDD6FE);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 12px 40px rgba(139,92,246,0.15);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
            </div>
        </div>

        <div class="error-code">419</div>

        <div class="relative z-10">
            <p
                style="color:var(--violet);font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                SESSION EXPIRÉE</p>
            <h1
                style="font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--dark);line-height:1.1;margin-bottom:16px;">
                Page expirée
            </h1>
            <p style="color:#888;font-size:16px;line-height:1.7;margin-bottom:32px;">
                Votre session a expiré pour des raisons de sécurité.<br>
                Pas de panique — rafraîchissez simplement la page.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button onclick="window.location.reload()" class="btn-primary"
                    style="border:none;cursor:pointer;font-family:inherit;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                        <path d="M16 16h5v5" />
                    </svg>
                    Rafraîchir la page
                </button>
                <a href="{{ url()->previous() }}" class="btn-secondary"
                    style="display:inline-flex;align-items:center;gap:8px;padding:14px 28px;background:transparent;color:#555;font-weight:600;border-radius:14px;font-size:15px;text-decoration:none;border:1.5px solid #e8e5e0;transition:all 0.2s ease;"
                    onmouseover="this.style.borderColor='#8B5CF6';this.style.background='rgba(139,92,246,0.05)'"
                    onmouseout="this.style.borderColor='#e8e5e0';this.style.background='transparent'">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 14 4 9l5-5" />
                        <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5v0a5.5 5.5 0 0 1-5.5 5.5H11" />
                    </svg>
                    Page précédente
                </a>
            </div>
        </div>
    </div>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
    </script>
</body>

</html>
