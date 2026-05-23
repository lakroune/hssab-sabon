<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-[#1b1b18] uppercase tracking-[0.2em]">
                    Mes Colocations
                </h2>
                <p class="text-gray-400 text-[9px] font-mono mt-1 uppercase tracking-wider">
                    ID: {{ auth()->id() }} &nbsp;·&nbsp; Session active
                </p>
            </div>
            <div class="flex gap-2">
                <button onclick="openModal('modalJoin')"
                    class="flex items-center gap-2 bg-white hover:bg-gray-50 text-[#1b1b18] px-5 py-2.5 text-xs font-bold transition border border-gray-200 uppercase tracking-widest rounded-xl shadow-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Rejoindre
                </button>
                <button onclick="openModal('modalCreate')"
                    class="flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-[#1b1b18] px-5 py-2.5 text-xs font-bold transition uppercase tracking-widest rounded-xl shadow-md shadow-amber-200/50">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Créer une coloc
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        .stat-card {
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 20px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            border-radius: 3px 0 0 3px;
        }

        .stat-card.amber::before {
            background: #F5A623;
        }

        .stat-card.green::before {
            background: #10B981;
        }

        .stat-card.rose::before {
            background: #F43F5E;
        }

        .stat-card.neutral::before {
            background: #94A3B8;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        /* coloc card */
        .coloc-card {
            background: white;
            border: 1.5px solid #f0f0ec;
            border-radius: 20px;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
            overflow: hidden;
        }

        .coloc-card:hover {
            border-color: #FBBF47;
            box-shadow: 0 16px 48px rgba(245, 166, 35, 0.08);
            transform: translateY(-3px);
        }

        .coloc-card:hover .card-arrow {
            transform: translateX(3px);
            color: #F5A623;
        }

        .card-top-bar {
            height: 3px;
            background: linear-gradient(90deg, #F5A623, #FBBF47);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .coloc-card:hover .card-top-bar {
            transform: scaleX(1);
        }

        .card-icon-wrap {
            width: 48px;
            height: 48px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s;
        }

        .coloc-card:hover .card-icon-wrap {
            transform: scale(1.05);
        }

        .role-badge {
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 4px 10px;
            border-radius: 99px;
        }

        .role-admin {
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .role-member {
            background: #F1F5F9;
            color: #475569;
            border: 1px solid #E2E8F0;
        }

        .member-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            background: #FEF3C7;
            color: #92400E;
        }

        .member-avatar.overflow {
            background: #F1F5F9;
            color: #64748B;
        }

        .card-arrow {
            transition: transform 0.2s, color 0.2s;
            color: #aaa;
        }

        /* empty state */
        .empty-state {
            grid-column: 1 / -1;
            border: 1.5px dashed #e8e5e0;
            border-radius: 24px;
            padding: 80px 40px;
            text-align: center;
            background: #FAFAF8;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        /* modals */
        .modal-hidden {
            display: none;
        }

        .modal-wrap {
            position: fixed;
            inset: 0;
            z-index: 150;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 80px;
            padding-left: 16px;
            padding-right: 16px;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(27, 27, 24, 0.55);
            backdrop-filter: blur(6px);
        }

        .modal-box {
            position: relative;
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 24px;
            width: 100%;
            max-width: 440px;
            padding: 36px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
            animation: modalIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f0f0ec;
        }

        .modal-title {
            font-size: 13px;
            font-weight: 800;
            color: #1b1b18;
            text-transform: uppercase;
            letter-spacing: 0.15em;
        }

        .modal-close {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f5f5f3;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            transition: background 0.15s, color 0.15s;
        }

        .modal-close:hover {
            background: #ebebeb;
            color: #1b1b18;
        }

        .modal-field label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #888;
            margin-bottom: 7px;
        }

        .modal-field input {
            width: 100%;
            padding: 12px 16px;
            background: #FAFAF8;
            border: 1.5px solid #ebebeb;
            border-radius: 12px;
            font-size: 14px;
            color: #1b1b18;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modal-field input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.1);
            background: white;
        }

        .modal-field input.mono {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .btn-cancel {
            flex: 1;
            padding: 12px;
            background: #f5f5f3;
            color: #555;
            border: none;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
        }

        .btn-cancel:hover {
            background: #ebebeb;
        }

        .btn-confirm-amber {
            flex: 2;
            padding: 12px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            color: #1b1b18;
            border: none;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 16px rgba(245, 166, 35, 0.3);
            transition: all 0.2s;
        }

        .btn-confirm-amber:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(245, 166, 35, 0.4);
        }

        .btn-confirm-dark {
            flex: 2;
            padding: 12px;
            background: #1b1b18;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
        }

        .btn-confirm-dark:hover {
            background: #2d2d28;
            transform: translateY(-1px);
        }

        /* reveal animation */
        [data-reveal] {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        [data-reveal].visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ── STATS ROW ── -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

                <div class="stat-card amber" data-reveal>
                    <div class="stat-icon" style="background:#FFFBEB;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <p style="font-size:10px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:0.1em;">
                        Colocs actives</p>
                    <p style="font-size:32px;font-weight:300;color:#1b1b18;margin-top:6px;line-height:1;">
                        {{ $colocations->count() }}</p>
                </div>

                <div class="stat-card green" data-reveal style="transition-delay:0.06s;">
                    <div class="stat-icon" style="background:#ECFDF5;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981"
                            stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                            <polyline points="17 6 23 6 23 12" />
                        </svg>
                    </div>
                    <p style="font-size:10px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:0.1em;">
                        Crédit total</p>
                    <p style="font-size:26px;font-weight:700;color:#10B981;margin-top:6px;line-height:1;">
                        {{ number_format($totalCredits, 2) }}
                        <span style="font-size:11px;font-weight:400;color:#aaa;">MAD</span>
                    </p>
                </div>

                <div class="stat-card rose" data-reveal style="transition-delay:0.12s;">
                    <div class="stat-icon" style="background:#FFF1F2;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F43F5E"
                            stroke-width="2">
                            <polyline points="23 18 13.5 8.5 8.5 13.5 1 6" />
                            <polyline points="17 18 23 18 23 12" />
                        </svg>
                    </div>
                    <p style="font-size:10px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:0.1em;">
                        Dette totale</p>
                    <p style="font-size:26px;font-weight:700;color:#F43F5E;margin-top:6px;line-height:1;">
                        {{ number_format($totalDebts, 2) }}
                        <span style="font-size:11px;font-weight:400;color:#aaa;">MAD</span>
                    </p>
                </div>

                <div class="stat-card {{ $totalCredits - $totalDebts >= 0 ? 'green' : 'rose' }}" data-reveal
                    style="transition-delay:0.18s;">
                    <div class="stat-icon"
                        style="background:{{ $totalCredits - $totalDebts >= 0 ? '#ECFDF5' : '#FFF1F2' }};">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="{{ $totalCredits - $totalDebts >= 0 ? '#10B981' : '#F43F5E' }}" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <p style="font-size:10px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:0.1em;">
                        Solde net</p>
                    <p
                        style="font-size:26px;font-weight:700;font-family:'Courier New',monospace;color:{{ $totalCredits - $totalDebts >= 0 ? '#10B981' : '#F43F5E' }};margin-top:6px;line-height:1;">
                        {{ $totalCredits - $totalDebts >= 0 ? '+' : '' }}{{ number_format($totalCredits - $totalDebts, 2) }}
                    </p>
                </div>
            </div>

            <!-- ── SECTION HEADER ── -->
            <div class="flex items-center justify-between mb-6" data-reveal>
                <div class="flex items-center gap-3">
                    <div
                        style="width:3px;height:20px;background:linear-gradient(180deg,#F5A623,#FBBF47);border-radius:3px;">
                    </div>
                    <p
                        style="font-size:11px;font-weight:700;color:#1b1b18;text-transform:uppercase;letter-spacing:0.15em;">
                        {{ $colocations->count() }} colocation{{ $colocations->count() !== 1 ? 's' : '' }}
                    </p>
                </div>
                <p style="font-size:10px;color:#bbb;font-family:'Courier New',monospace;">
                    Triées par date de création
                </p>
            </div>

            <!-- ── COLOC CARDS ── -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($colocations as $i => $coloc)
                    <div class="coloc-card" data-reveal style="transition-delay:{{ $i * 0.07 }}s;">
                        <div class="card-top-bar"></div>
                        <div style="padding:28px;">

                            <!-- Header row -->
                            <div
                                style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                                <div class="card-icon-wrap">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="#F5A623" stroke-width="1.5">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>
                                </div>
                                <span
                                    class="role-badge {{ ($coloc->pivot->role ?? 'member') === 'admin' ? 'role-admin' : 'role-member' }}">
                                    {{ $coloc->pivot->role ?? 'Membre' }}
                                </span>
                            </div>

                            <!-- Name & code -->
                            <h4
                                style="font-size:16px;font-weight:800;color:#1b1b18;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">
                                {{ $coloc->name }}
                            </h4>
                            <div style="display:flex;align-items:center;gap:6px;margin-bottom:20px;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                    stroke="#ccc" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" />
                                    <path d="M16 7V5a2 2 0 0 0-4 0v2" />
                                </svg>
                                <p
                                    style="font-size:10px;font-family:'Courier New',monospace;color:#f00 ;font-weight:700;letter-spacing:0.15em;">
                                    vous deposez {{ number_format($coloc->my_total_spent ?? 0, 2) }} MAD
                                </p>
                            </div>

                            <!-- Divider -->
                            <div style="height:1px;background:#f5f5f2;margin-bottom:18px;"></div>

                            <!-- Footer -->
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <!-- Avatars -->
                                <div style="display:flex;align-items:center;gap:-4px;">
                                    <div style="display:flex;">
                                        @foreach ($coloc->members->take(4) as $member)
                                            <div class="member-avatar"
                                                style="margin-left:{{ $loop->first ? '0' : '-8px' }};"
                                                title="{{ $member->name }}">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                        @endforeach
                                        @if ($coloc->members->count() > 4)
                                            <div class="member-avatar overflow" style="margin-left:-8px;">
                                                +{{ $coloc->members->count() - 4 }}
                                            </div>
                                        @endif
                                    </div>
                                    <span style="font-size:10px;color:#bbb;margin-left:8px;">
                                        {{ $coloc->members->count() }}
                                        membre{{ $coloc->members->count() !== 1 ? 's' : '' }}
                                    </span>
                                </div>

                                <!-- Open link -->
                                <a href="{{ route('colocations.show', $coloc) }}"
                                    style="display:inline-flex;align-items:center;gap:5px;font-size:11px;font-weight:700;color:#1b1b18;text-decoration:none;text-transform:uppercase;letter-spacing:0.08em;border-bottom:2px solid #F5A623;padding-bottom:1px;">
                                    <span>Ouvrir</span>
                                    <svg class="card-arrow" width="12" height="12" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" data-reveal>
                        <div class="empty-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                                stroke-width="1.5">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </div>
                        <p
                            style="font-size:11px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:0.3em;margin-bottom:8px;">
                            Aucune colocation
                        </p>
                        <p style="font-size:13px;color:#ccc;margin-bottom:28px;">
                            Crée ou rejoins une coloc pour commencer.
                        </p>
                        <div style="display:flex;justify-content:center;gap:10px;">
                            <button onclick="openModal('modalJoin')"
                                style="padding:10px 20px;border:1.5px solid #e8e5e0;border-radius:10px;font-size:12px;font-weight:700;background:white;cursor:pointer;font-family:inherit;text-transform:uppercase;letter-spacing:0.08em;color:#555;transition:border-color 0.2s;"
                                onmouseover="this.style.borderColor='#F5A623'"
                                onmouseout="this.style.borderColor='#e8e5e0'">
                                Rejoindre
                            </button>
                            <button onclick="openModal('modalCreate')"
                                style="padding:10px 20px;border:none;border-radius:10px;font-size:12px;font-weight:700;background:linear-gradient(135deg,#F5A623,#FBBF47);color:#1b1b18;cursor:pointer;font-family:inherit;text-transform:uppercase;letter-spacing:0.08em;box-shadow:0 4px 14px rgba(245,166,35,0.3);">
                                Créer une coloc
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- ════════ MODAL: CRÉER ════════ -->
    <div id="modalCreate" class="modal-hidden">
        <div class="modal-wrap">
            <div class="modal-overlay" onclick="closeModal('modalCreate')"></div>
            <div class="modal-box">
                <div class="modal-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div
                            style="width:32px;height:32px;background:#FFFBEB;border:1px solid #FDE68A;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#F5A623"
                                stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </div>
                        <span class="modal-title">Nouvelle colocation</span>
                    </div>
                    <button class="modal-close" onclick="closeModal('modalCreate')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('colocations.store') }}">
                    @csrf
                    <div class="modal-field" style="margin-bottom:24px;">
                        <label>Nom de la colocation</label>
                        <input type="text" name="name" required placeholder="Ex: Coloc Maarif, Casa 4">
                        <p style="font-size:10px;color:#bbb;margin-top:6px;">
                            Un code d'invitation sera généré automatiquement.
                        </p>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="button" class="btn-cancel"
                            onclick="closeModal('modalCreate')">Annuler</button>
                        <button type="submit" class="btn-confirm-amber">Créer la coloc</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ════════ MODAL: REJOINDRE ════════ -->
    <div id="modalJoin" class="modal-hidden">
        <div class="modal-wrap">
            <div class="modal-overlay" onclick="closeModal('modalJoin')"></div>
            <div class="modal-box">
                <div class="modal-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div
                            style="width:32px;height:32px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1b1b18"
                                stroke-width="2">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                        </div>
                        <span class="modal-title">Rejoindre une coloc</span>
                    </div>
                    <button class="modal-close" onclick="closeModal('modalJoin')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('colocations.join') }}">
                    @csrf
                    <div class="modal-field" style="margin-bottom:24px;">
                        <label>Code d'invitation</label>
                        <input type="text" name="invitation_code" required class="mono"
                            placeholder="EX: ABC-1234" oninput="this.value = this.value.toUpperCase()">
                        <p style="font-size:10px;color:#bbb;margin-top:6px;">
                            Demande le code à ton colocataire.
                        </p>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="button" class="btn-cancel" onclick="closeModal('modalJoin')">Annuler</button>
                        <button type="submit" class="btn-confirm-dark">Rejoindre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('modal-hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('modal-hidden');
            document.body.style.overflow = '';
        }
        // close on Escape
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                ['modalCreate', 'modalJoin'].forEach(closeModal);
            }
        });

        // scroll reveal
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

</x-app-layout>
