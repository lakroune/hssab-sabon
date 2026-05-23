<x-guest-legal>
    <x-slot name="title">CGU · Hsab Sabon</x-slot>

    <style>
        .legal-wrap {
            max-width: 720px;
            margin: 0 auto;
            padding: 48px 24px 96px;
        }

        .legal-hero {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 48px;
            padding: 28px 32px;
            background: #1b1b18;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }

        .legal-hero::after {
            content: 'CGU';
            position: absolute;
            right: 24px;
            font-family: 'Playfair Display', serif;
            font-size: 72px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.04);
            line-height: 1;
            pointer-events: none;
        }

        .legal-hero-icon {
            width: 52px;
            height: 52px;
            background: rgba(245, 166, 35, 0.15);
            border: 1px solid rgba(245, 166, 35, 0.3);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .legal-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 900;
            color: white;
            line-height: 1.15;
        }

        .legal-hero p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 4px;
        }

        .toc-block {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 16px;
            padding: 22px 28px;
            margin-bottom: 24px;
        }

        .toc-label {
            font-size: 9px;
            font-weight: 800;
            color: #92400E;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 12px;
        }

        .toc-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 24px;
        }

        @media (max-width: 600px) {
            .toc-list {
                grid-template-columns: 1fr;
            }
        }

        .toc-list a {
            font-size: 12px;
            color: #92400E;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.15s;
        }

        .toc-list a:hover {
            color: #D48A10;
        }

        .toc-list a::before {
            content: '';
            width: 4px;
            height: 4px;
            background: #F5A623;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .section-block {
            margin-bottom: 20px;
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 16px;
            padding: 28px 32px;
            scroll-margin-top: 80px;
        }

        .section-num {
            font-size: 9px;
            font-weight: 800;
            color: #F5A623;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 6px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 800;
            color: #1b1b18;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f5f5f2;
        }

        .section-body {
            font-size: 13.5px;
            color: #555;
            line-height: 1.8;
        }

        .section-body strong {
            color: #1b1b18;
            font-weight: 700;
        }

        .section-body ul {
            margin: 10px 0;
            list-style: none;
        }

        .section-body ul li {
            position: relative;
            padding-left: 18px;
            margin-bottom: 6px;
        }

        .section-body ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 9px;
            width: 6px;
            height: 6px;
            background: #F5A623;
            border-radius: 50%;
        }

        .beta-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #1b1b18;
            color: #F5A623;
            border-radius: 99px;
            padding: 5px 12px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 12px;
        }

        /* --- SCROLL REVEAL ANIMATIONS --- */
        [data-reveal] {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }

        [data-reveal].visible {
            opacity: 1;
            transform: translateY(0);
        }

        [data-reveal-delay="0.1s"] {
            transition-delay: 0.1s;
        }

        [data-reveal-delay="0.15s"] {
            transition-delay: 0.15s;
        }

        [data-reveal-delay="0.2s"] {
            transition-delay: 0.2s;
        }

        [data-reveal-delay="0.3s"] {
            transition-delay: 0.3s;
        }
    </style>

    <div class="legal-wrap">
        <div class="legal-hero" data-reveal>
            <div class="legal-hero-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                </svg>
            </div>
            <div>
                <h1>Conditions Générales<br>d'Utilisation</h1>
                <p>En utilisant Hsab Sabon, vous acceptez les présentes conditions.</p>
            </div>
        </div>

        <div class="toc-block" data-reveal data-reveal-delay="0.1s">
            <p class="toc-label">Sommaire</p>
            <div class="toc-list">
                <a href="#art1">Objet du service</a>
                <a href="#art2">Inscription & compte</a>
                <a href="#art3">Utilisation acceptable</a>
                <a href="#art4">Données & vie privée</a>
                <a href="#art5">Disponibilité BETA</a>
                <a href="#art6">Responsabilité</a>
                <a href="#art7">Modification des CGU</a>
                <a href="#art8">Contact</a>
            </div>
        </div>

        <div class="section-block" id="art1" data-reveal>
            <p class="section-num">Article 01</p>
            <p class="section-title">Objet du service</p>
            <div class="section-body">
                <p><strong>Hsab Sabon</strong> est une application web gratuite permettant à des colocataires de gérer
                    leurs dépenses partagées en dirhams (MAD). Actuellement en phase <strong>BETA</strong>.</p>
                <p style="margin-top:10px;">Hsab Sabon n'est pas un service de paiement ni un établissement financier.
                    Aucune transaction monétaire réelle n'est effectuée via la plateforme.</p>
            </div>
        </div>

        <div class="section-block" id="art2" data-reveal data-reveal-delay="0.1s">
            <p class="section-num">Article 02</p>
            <p class="section-title">Inscription & Compte</p>
            <div class="section-body">
                <p>Pour utiliser Hsab Sabon, vous devez :</p>
                <ul>
                    <li>Avoir au moins 18 ans</li>
                    <li>Fournir une adresse e-mail valide</li>
                    <li>Créer un mot de passe sécurisé</li>
                </ul>
                <p style="margin-top:10px;">Vous êtes <strong>seul responsable</strong> de la confidentialité de vos
                    identifiants.</p>
            </div>
        </div>

        <div class="section-block" id="art3" data-reveal data-reveal-delay="0.15s">
            <p class="section-num">Article 03</p>
            <p class="section-title">Utilisation acceptable</p>
            <div class="section-body">
                <p>Il est interdit d'utiliser Hsab Sabon pour :</p>
                <ul>
                    <li>Toute activité illégale ou frauduleuse</li>
                    <li>Harceler, menacer ou escroquer d'autres utilisateurs</li>
                    <li>Accéder aux données d'autres colocations sans invitation</li>
                    <li>Automatiser l'accès ou scraper la plateforme</li>
                </ul>
                <p style="margin-top:10px;">Tout manquement peut entraîner la suspension immédiate du compte.</p>
            </div>
        </div>

        <div class="section-block" id="art4" data-reveal data-reveal-delay="0.2s">
            <p class="section-num">Article 04</p>
            <p class="section-title">Données & Vie privée</p>
            <div class="section-body">
                <p>Le traitement de vos données est décrit dans notre <a href="{{ route('legal.privacy') }}"
                        style="color:#F5A623;font-weight:700;text-decoration:none;">Politique de Confidentialité</a>,
                    qui fait partie intégrante des présentes CGU.</p>
            </div>
        </div>

        <div class="section-block" id="art5" data-reveal data-reveal-delay="0.25s">
            <p class="section-num">Article 05</p>
            <p class="section-title">Disponibilité — Phase BETA</p>
            <div class="section-body">
                <span class="beta-badge">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Version BETA
                </span>
                <p>Le service est fourni "tel quel". Nous ne garantissons pas une disponibilité continue, l'absence de
                    bugs, ni la conservation permanente des données en BETA.</p>
            </div>
        </div>

        <div class="section-block" id="art6" data-reveal data-reveal-delay="0.3s">
            <p class="section-num">Article 06</p>
            <p class="section-title">Responsabilité</p>
            <div class="section-body">
                <p>Hsab Sabon n'est pas responsable des litiges entre colocataires liés aux dépenses enregistrées.
                    L'application est un outil de suivi, pas un arbitre des conflits.</p>
            </div>
        </div>

        <div class="section-block" id="art7" data-reveal data-reveal-delay="0.35s">
            <p class="section-num">Article 07</p>
            <p class="section-title">Modification des CGU</p>
            <div class="section-body">
                <p>Nous pouvons mettre à jour les présentes CGU à tout moment. La poursuite de l'utilisation du service
                    vaut acceptation des nouvelles conditions.</p>
            </div>
        </div>

        <div class="section-block" id="art8" data-reveal data-reveal-delay="0.4s">
            <p class="section-num">Article 08</p>
            <p class="section-title">Contact</p>
            <div class="section-body">
                <div
                    style="margin-top:4px;display:flex;align-items:center;gap:8px;padding:14px 18px;background:#FAFAF8;border:1px solid #ebebeb;border-radius:12px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                        stroke-width="2">
                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                    </svg>
                    <span style="font-size:13px;font-weight:700;color:#1b1b18;">contact@hsabsabon.ma</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Scroll reveal (one time only)
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        });
        document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));
    </script>
</x-guest-legal>
