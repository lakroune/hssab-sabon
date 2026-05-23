    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 — Hsab Sabon</title>
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

            .coin-float {
                animation: floatCoin 3s ease-in-out infinite;
            }

            @keyframes floatCoin {

                0%,
                100% {
                    transform: translateY(0) rotate(-2deg);
                }

                50% {
                    transform: translateY(-12px) rotate(2deg);
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

            .btn-secondary {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 14px 28px;
                background: transparent;
                color: #555;
                font-weight: 600;
                border-radius: 14px;
                font-size: 15px;
                text-decoration: none;
                border: 1.5px solid #e8e5e0;
                transition: all 0.2s ease;
            }

            .btn-secondary:hover {
                border-color: var(--amber);
                background: rgba(245, 166, 35, 0.05);
            }

            .error-code {
                font-family: 'Playfair Display', serif;
                font-size: clamp(120px, 15vw, 200px);
                font-weight: 900;
                line-height: 1;
                background: linear-gradient(135deg, var(--amber), var(--amber-light));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                opacity: 0.15;
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
        <!-- Background pattern -->
        <div
            style="position:absolute;inset:0;background-image:
            radial-gradient(circle at 20% 80%, rgba(245,166,35,0.06) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245,166,35,0.04) 0%, transparent 40%);
            pointer-events:none;">
        </div>

        <div class="relative z-10 text-center px-6 max-w-lg" data-reveal>
            <!-- Floating coin -->
            <div class="coin-float" style="margin-bottom: 24px;">
                <div
                    style="width:72px;height:72px;background:linear-gradient(135deg,#FBBF47,#D48A10);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 12px 40px rgba(245,166,35,0.35);">
                    <span style="color:white;font-size:22px;font-weight:900;font-family:'Instrument Sans';">?</span>
                </div>
            </div>

            <!-- Big 404 background -->
            <div class="error-code">404</div>

            <div class="relative z-10">
                <p
                    style="color:var(--amber);font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:12px;">
                    OUPS !</p>
                <h1
                    style="font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--dark);line-height:1.1;margin-bottom:16px;">
                    Page introuvable
                </h1>
                <p style="color:#888;font-size:16px;line-height:1.7;margin-bottom:32px;">
                    La page que vous cherchez n'existe pas ou a été déplacée.<br>
                    Peut-être qu'elle a pris ses clics et s'en est allée ?
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
                    <a href="{{ url()->previous() }}" class="btn-secondary">
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
