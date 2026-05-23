<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900i"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --amber: #F5A623;
            --amber-light: #FBBF47;
            --dark: #1b1b18;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #FDFDFC;
        }

        .gear-spin {
            animation: spinGear 4s linear infinite;
        }

        .gear-spin-reverse {
            animation: spinGear 4s linear infinite reverse;
        }

        @keyframes spinGear {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
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
            background: linear-gradient(135deg, #94A3B8, #CBD5E1);
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
        radial-gradient(circle at 50% 50%, rgba(148,163,184,0.06) 0%, transparent 60%);
        pointer-events:none;">
    </div>

    <div class="relative z-10 text-center px-6 max-w-lg" data-reveal>
        <!-- Gears icon -->
        <div
            style="margin-bottom: 24px; position: relative; width: 80px; height: 80px; margin-left: auto; margin-right: auto;">
            <svg class="gear-spin" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#94A3B8"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                style="position:absolute;top:0;left:0;">
                <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                <path d="M12 2v2" />
                <path d="M12 20v2" />
                <path d="m4.93 4.93 1.41 1.41" />
                <path d="m17.66 17.66 1.41 1.41" />
                <path d="M2 12h2" />
                <path d="M20 12h2" />
                <path d="m6.34 17.66-1.41 1.41" />
                <path d="m19.07 4.93-1.41 1.41" />
            </svg>
            <svg class="gear-spin-reverse" width="32" height="32" viewBox="0 0 24 24" fill="none"
                stroke="#F5A623" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                style="position:absolute;bottom:0;right:0;">
                <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                <path d="M12 2v2" />
                <path d="M12 20v2" />
                <path d="m4.93 4.93 1.41 1.41" />
                <path d="m17.66 17.66 1.41 1.41" />
                <path d="M2 12h2" />
                <path d="M20 12h2" />
                <path d="m6.34 17.66-1.41 1.41" />
                <path d="m19.07 4.93-1.41 1.41" />
            </svg>
        </div>

        <div class="error-code">500</div>

        <div class="relative z-10">
            <p
                style="color:#94A3B8;font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                ERREUR INTERNE</p>
            <h1
                style="font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--dark);line-height:1.1;margin-bottom:16px;">
                Erreur serveur
            </h1>
            <p style="color:#888;font-size:16px;line-height:1.7;margin-bottom:32px;">
                Une erreur interne est survenue.<br>
                Nos équipes ont été notifiées et travaillent sur le problème.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/') }}" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Retour à l'accueil
                </a>
                <button onclick="window.location.reload()" class="btn-secondary"
                    style="display:inline-flex;align-items:center;gap:8px;padding:14px 28px;background:transparent;color:#555;font-weight:600;border-radius:14px;font-size:15px;text-decoration:none;border:1.5px solid #e8e5e0;transition:all 0.2s ease;cursor:pointer;font-family:inherit;"
                    onmouseover="this.style.borderColor='#F5A623';this.style.background='rgba(245,166,35,0.05)'"
                    onmouseout="this.style.borderColor='#e8e5e0';this.style.background='transparent'">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                        <path d="M16 16h5v5" />
                    </svg>
                    Réessayer
                </button>
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
