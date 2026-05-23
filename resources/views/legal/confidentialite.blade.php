<x-guest-legal>
    <x-slot name="title">Confidentialité · Hsab Sabon</x-slot>

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
            background: white;
            border: 1.5px solid #f0f0ec;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }

        .legal-hero::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #F5A623, #FBBF47);
            border-radius: 4px 0 0 4px;
        }

        .legal-hero-icon {
            width: 52px;
            height: 52px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .legal-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            color: #1b1b18;
            line-height: 1.15;
        }

        .legal-hero p {
            font-size: 13px;
            color: #999;
            margin-top: 4px;
        }

        .section-block {
            margin-bottom: 20px;
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 16px;
            padding: 28px 32px;

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
            margin: 10px 0 10px 0;
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

        .contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 99px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            color: #92400E;
            margin-top: 10px;
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
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
            </div>
            <div>
                <h1>Politique de<br>Confidentialité</h1>
                <p>Comment Hsab Sabon protège vos données personnelles.</p>
            </div>
        </div>

        <div class="section-block" data-reveal data-reveal-delay="0.1s">
            <p class="section-num">01</p>
            <p class="section-title">Collecte des données</p>
            <div class="section-body">
                <p>Dans le cadre de l'utilisation de <strong>Hsab Sabon</strong>, nous collectons uniquement les données
                    strictement nécessaires :</p>
                <ul>
                    <li>Adresse e-mail et nom d'utilisateur (lors de l'inscription)</li>
                    <li>Données de dépenses et transactions saisies volontairement</li>
                    <li>Journaux de connexion (adresse IP, horodatage)</li>
                </ul>
                <p>Nous ne collectons jamais de données de paiement réel ni de coordonnées bancaires.</p>
            </div>
        </div>

        <div class="section-block" data-reveal data-reveal-delay="0.15s">
            <p class="section-num">02</p>
            <p class="section-title">Utilisation des données</p>
            <div class="section-body">
                <p>Vos données sont utilisées exclusivement pour :</p>
                <ul>
                    <li>Fournir et améliorer le service Hsab Sabon</li>
                    <li>Assurer la sécurité et prévenir les abus</li>
                    <li>Vous envoyer des notifications liées à votre compte (avec votre consentement)</li>
                </ul>
                <p><strong>Aucune donnée n'est vendue ou partagée</strong> avec des tiers à des fins commerciales.</p>
            </div>
        </div>

        <div class="section-block" data-reveal data-reveal-delay="0.2s">
            <p class="section-num">03</p>
            <p class="section-title">Conservation & Suppression</p>
            <div class="section-body">
                <p>Vos données sont conservées tant que votre compte est actif. Vous pouvez demander la suppression à
                    tout moment en nous contactant.</p>
                <p style="margin-top:10px;">Suppression dans un délai de <strong>30 jours</strong> suivant votre
                    demande.</p>
            </div>
        </div>

        <div class="section-block" data-reveal data-reveal-delay="0.25s">
            <p class="section-num">04</p>
            <p class="section-title">Sécurité</p>
            <div class="section-body">
                <ul>
                    <li>Chiffrement HTTPS sur toutes les communications</li>
                    <li>Mots de passe hachés (bcrypt)</li>
                    <li>Accès aux données limité aux membres de votre colocation</li>
                </ul>
            </div>
        </div>

        <div class="section-block" data-reveal data-reveal-delay="0.3s">
            <p class="section-num">05</p>
            <p class="section-title">Vos droits</p>
            <div class="section-body">
                <ul>
                    <li>Droit d'accès à vos données personnelles</li>
                    <li>Droit de rectification des données inexactes</li>
                    <li>Droit à l'effacement ("droit à l'oubli")</li>
                    <li>Droit à la portabilité de vos données</li>
                </ul>
                <p style="margin-top:10px;">Pour exercer ces droits :</p>
                <span class="contact-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                    </svg>
                    contact@hsabsabon.ma
                </span>
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
