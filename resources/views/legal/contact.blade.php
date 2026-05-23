<x-guest-legal>
    <x-slot name="title">Contact · Hsab Sabon</x-slot>

    <style>
        .contact-wrap {
            max-width: 720px;
            margin: 0 auto;
            padding: 48px 24px 96px;
        }

        .contact-hero {
            padding: 36px 40px;
            background: linear-gradient(135deg, #1b1b18 0%, #2a2a22 100%);
            border-radius: 24px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.15), transparent 70%);
            border-radius: 50%;
        }

        .contact-hero-inner {
            position: relative;
            z-index: 1;
        }

        .contact-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            color: white;
            line-height: 1.15;
            margin-bottom: 8px;
        }

        .contact-hero h1 em {
            color: #F5A623;
            font-style: normal;
        }

        .contact-hero p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 600px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        .info-card {
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 14px;

        }


        .info-card-icon {
            width: 40px;
            height: 40px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-card-label {
            font-size: 9px;
            font-weight: 800;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 4px;
        }

        .info-card-value {
            font-size: 13px;
            font-weight: 700;
            color: #1b1b18;
        }

        .info-card-sub {
            font-size: 11px;
            color: #bbb;
            margin-top: 2px;
        }

        .form-card {
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 20px;
            padding: 36px;

        }


        .form-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f5f5f2;
        }

        .form-header-title {
            font-size: 12px;
            font-weight: 800;
            color: #1b1b18;
            text-transform: uppercase;
            letter-spacing: 0.15em;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #888;
            margin-bottom: 8px;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 12px 16px;
            background: #FAFAF8;
            border: 1.5px solid #ebebeb;
            border-radius: 12px;
            font-size: 14px;
            color: #1b1b18;
            font-family: 'Instrument Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            resize: none;
        }

        .field input::placeholder,
        .field textarea::placeholder {
            color: #c0bdb8;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.1);
            background: white;
        }

        .field select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23ccc' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            color: #1b1b18;
            font-weight: 800;
            font-size: 13px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-family: 'Instrument Sans', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            box-shadow: 0 8px 24px rgba(245, 166, 35, 0.35);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(245, 166, 35, 0.45);
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

    <div class="contact-wrap">
        <div class="contact-hero" data-reveal>
            <div class="contact-hero-inner">
                <h1>Une question ?<br>On est <em>là.</em></h1>
                <p>L'équipe Hsab Sabon répond dans les 48 heures ouvrées.</p>
            </div>
        </div>

        <div class="grid-2">
            <div class="info-card" data-reveal data-reveal-delay="0.1s">
                <div class="info-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                        stroke-width="1.5">
                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                    </svg>
                </div>
                <div>
                    <p class="info-card-label">Email</p>
                    <p class="info-card-value">contact@hsabsabon.ma</p>
                    <p class="info-card-sub">Réponse sous 48h</p>
                </div>
            </div>

            <div class="info-card" data-reveal data-reveal-delay="0.15s">
                <div class="info-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                        stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                </div>
                <div>
                    <p class="info-card-label">Version</p>
                    <p class="info-card-value">BETA publique</p>
                    <p class="info-card-sub">Gratuit · Maroc</p>
                </div>
            </div>
        </div>

        <div class="form-card" data-reveal data-reveal-delay="0.2s">
            <div class="form-header">
                <div
                    style="width:32px;height:32px;background:#FFFBEB;border:1px solid #FDE68A;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                        stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                </div>
                <span class="form-header-title">Envoyer un message</span>
            </div>

            @if (session('success'))
                <div
                    style="background:#ECFDF5;border:1px solid #A7F3D0;border-radius:12px;padding:14px 18px;font-size:13px;color:#065F46;font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                <div class="grid-2" style="margin-bottom:20px;">
                    <div class="field" style="margin-bottom:0;">
                        <label>Votre nom</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}"
                            placeholder="Prénom Nom" required>
                        @error('name')
                            <p style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field" style="margin-bottom:0;">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}"
                            placeholder="ton@email.com" required>
                        @error('email')
                            <p style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label>Sujet</label>
                    <select name="subject" required>
                        <option value="" disabled selected>Choisir un sujet…</option>
                        <option value="bug" {{ old('subject') === 'bug' ? 'selected' : '' }}><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-bug"
                                style="display:inline-block;vertical-align:middle;margin-right:4px;">
                                <path d="m8 2 1.88 1.88" />
                                <path d="M14.12 3.88 16 2" />
                                <path d="M9 7.13v-1a3.003 3.003 0 1 1 6 0v1" />
                                <path d="M12 20c-3.3 0-6-2.7-6-6v-3a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v3c0 3.3-2.7 6-6 6" />
                                <path d="M12 20v-9" />
                                <path d="M6.53 9C4.6 8.8 3 7.1 3 5" />
                                <path d="M6 13H2" />
                                <path d="M3 21c0-2.1 1.7-3.9 3.8-4" />
                                <path d="M20.97 5c0 2.1-1.6 3.9-3.5 4" />
                                <path d="M22 13h-4" />
                                <path d="M17.2 17c2.1.1 3.8 1.9 3.8 4" />
                            </svg> Signaler un bug
                        </option>
                        <option value="feature" {{ old('subject') === 'feature' ? 'selected' : '' }}><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-lightbulb"
                                style="display:inline-block;vertical-align:middle;margin-right:4px;">
                                <path
                                    d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5" />
                                <path d="M9 18h6" />
                                <path d="M10 22h4" />
                            </svg> Suggestion
                        </option>
                        <option value="account" {{ old('subject') === 'account' ? 'selected' : '' }}><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user"
                                style="display:inline-block;vertical-align:middle;margin-right:4px;">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg> Problème de
                            compte</option>
                        <option value="legal" {{ old('subject') === 'legal' ? 'selected' : '' }}><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-scale"
                                style="display:inline-block;vertical-align:middle;margin-right:4px;">
                                <path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z" />
                                <path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z" />
                                <path d="M7 21h10" />
                                <path d="M12 3v18" />
                                <path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2" />
                            </svg> Question légale
                        </option>
                        <option value="other" {{ old('subject') === 'other' ? 'selected' : '' }}><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail"
                                style="display:inline-block;vertical-align:middle;margin-right:4px;">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg> Autre</option>
                    </select>
                    @error('subject')
                        <p style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label>Message</label>
                    <textarea name="message" rows="5" placeholder="Décris ton problème ou ta suggestion…" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="22" y1="2" x2="11" y2="13" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                    </svg>
                    Envoyer le message
                </button>
            </form>
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
