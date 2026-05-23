<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <a href="{{ route('dashboard') }}"
                        style="display:inline-flex;align-items:center;gap:4px;font-size:11px;color:#bbb;font-weight:600;text-decoration:none;text-transform:uppercase;letter-spacing:0.08em;transition:color 0.2s;"
                        onmouseover="this.style.color='#F5A623'" onmouseout="this.style.color='#bbb'">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Colocations
                    </a>
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#ddd"
                        stroke-width="2">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                    <span
                        style="font-size:11px;color:#bbb;text-transform:uppercase;letter-spacing:0.08em;">{{ $colocation->name }}</span>
                </div>
                <h2
                    style="font-size:20px;font-weight:800;color:#1b1b18;text-transform:uppercase;letter-spacing:0.12em;line-height:1;">
                    {{ $colocation->name }}
                </h2>
                @if ($colocation->owner_id === auth()->id())
                    <div style="display:flex;align-items:center;gap:8px;margin-top:6px;">
                        <span
                            style="font-size:10px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:0.1em;">Code</span>
                        <span id="invitationCode"
                            style="background:#FFFBEB;color:#92400E;border:1px solid #FDE68A;padding:3px 10px;border-radius:8px;font-size:11px;font-family:'Courier New',monospace;font-weight:700;letter-spacing:0.15em;">
                            {{ $colocation->invitation_code }}
                        </span>
                        <button onclick="copyCode()" title="Copier le code"
                            style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;border-radius:7px;border:1px solid #ebebeb;background:white;cursor:pointer;color:#bbb;transition:all 0.2s;"
                            onmouseover="this.style.borderColor='#F5A623';this.style.color='#F5A623';"
                            onmouseout="this.style.borderColor='#ebebeb';this.style.color='#bbb';">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="9" y="9" width="13" height="13" rx="2" />
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <div style="display:flex;gap:8px;align-items:center;">
                @if ($colocation->owner_id === auth()->id())
                    <form action="{{ route('colocations.regenerate', $colocation) }}" method="POST"
                        onsubmit="return confirm('Générer un nouveau code ? L\'ancien code sera désactivé.')">
                        @csrf
                        <button type="submit"
                            style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;background:white;border:1px solid #e8e5e0;border-radius:10px;font-size:11px;font-weight:700;color:#555;cursor:pointer;font-family:inherit;text-transform:uppercase;letter-spacing:0.08em;transition:all 0.2s;"
                            onmouseover="this.style.borderColor='#F5A623';this.style.color='#1b1b18';"
                            onmouseout="this.style.borderColor='#e8e5e0';this.style.color='#555';">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <polyline points="23 4 23 10 17 10" />
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                            </svg>
                            Reset code
                        </button>
                    </form>
                @endif
                <button onclick="openModal('addTransactionModal')"
                    style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:linear-gradient(135deg,#F5A623,#FBBF47);color:#1b1b18;border:none;border-radius:11px;font-size:11px;font-weight:800;cursor:pointer;font-family:inherit;text-transform:uppercase;letter-spacing:0.1em;box-shadow:0 6px 20px rgba(245,166,35,0.3);transition:all 0.2s;"
                    onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 10px 28px rgba(245,166,35,0.4)';"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 6px 20px rgba(245,166,35,0.3)';">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nouvelle transaction
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        /* sidebar cards */
        .side-card {
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 18px;
            overflow: hidden;
        }

        .side-card-accent {
            height: 3px;
        }

        /* balance cards */
        .balance-card {
            background: white;
            border: 1px solid #f0f0ec;
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .balance-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
        }

        .balance-card.green::before {
            background: #10B981;
        }

        .balance-card.rose::before {
            background: #F43F5E;
        }

        .balance-bg-icon {
            position: absolute;
            right: -8px;
            top: -8px;
            opacity: 0.04;
        }

        /* member row */
        .member-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            border-bottom: 1px solid #f8f8f5;
            transition: background 0.15s;
        }

        .member-row:last-child {
            border-bottom: none;
        }

        .member-row:hover {
            background: #FAFAF8;
        }

        .member-av {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
        }

        .kick-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 7px;
            border: 1px solid #FEE2E2;
            background: #FFF5F5;
            color: #EF4444;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            transition: all 0.15s;
        }

        .kick-btn:hover {
            background: #FEE2E2;
            border-color: #FCA5A5;
            color: #DC2626;
        }

        /* transactions table */
        .tx-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tx-table thead th {
            padding: 10px 20px;
            font-size: 9px;
            font-weight: 800;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            text-align: left;
            background: #FAFAF8;
            border-bottom: 1px solid #f0f0ec;
        }

        .tx-table thead th:last-child {
            text-align: right;
        }

        .tx-table tbody tr {
            border-bottom: 1px solid #f8f8f5;
            transition: background 0.15s;
        }

        .tx-table tbody tr:last-child {
            border-bottom: none;
        }

        .tx-table tbody tr:hover {
            background: #FAFAF8;
        }

        .tx-table td {
            padding: 14px 20px;
        }

        /* type badge */
        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .type-shared {
            background: #FFFBEB;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .type-p2p {
            background: #F0F9FF;
            color: #0369A1;
            border: 1px solid #BAE6FD;
        }

        /* delete btn */
        .del-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 7px;
            border: 1px solid #FEE2E2;
            background: transparent;
            color: #EF4444;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            transition: all 0.15s;
        }

        .del-btn:hover {
            background: #FFF5F5;
            border-color: #FCA5A5;
        }

        /* empty transactions */
        .tx-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .tx-empty-icon {
            width: 52px;
            height: 52px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        /* modal */
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
            padding: 60px 16px 16px;
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
            border-radius: 22px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.14);
            animation: modalIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) both;
            overflow: hidden;
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

        .modal-top-bar {
            height: 3px;
            background: linear-gradient(90deg, #F5A623, #FBBF47);
        }

        .modal-inner {
            padding: 28px 32px 32px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f0f0ec;
        }

        .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-title {
            font-size: 13px;
            font-weight: 800;
            color: #1b1b18;
            text-transform: uppercase;
            letter-spacing: 0.12em;
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
            transition: all 0.15s;
        }

        .modal-close:hover {
            background: #ebebeb;
            color: #1b1b18;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #999;
            margin-bottom: 6px;
        }

        .field-input {
            width: 100%;
            padding: 12px 14px;
            background: #FAFAF8;
            border: 1.5px solid #ebebeb;
            border-radius: 11px;
            font-size: 14px;
            color: #1b1b18;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .field-input:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.1);
            background: white;
        }

        .field-input::placeholder {
            color: #c8c5c0;
        }

        /* type selector cards */
        .type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .type-option {
            padding: 12px 14px;
            border: 1.5px solid #ebebeb;
            border-radius: 11px;
            cursor: pointer;
            transition: all 0.2s;
            background: #FAFAF8;
        }

        .type-option:hover {
            border-color: #FBBF47;
            background: white;
        }

        .type-option.selected {
            border-color: #F5A623;
            background: #FFFBEB;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.08);
        }

        .type-option-title {
            font-size: 12px;
            font-weight: 700;
            color: #1b1b18;
        }

        .type-option-sub {
            font-size: 10px;
            color: #aaa;
            margin-top: 2px;
        }

        .btn-cancel {
            flex: 1;
            padding: 13px;
            background: #f5f5f3;
            color: #555;
            border: none;
            border-radius: 11px;
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

        .btn-submit-amber {
            flex: 2;
            padding: 13px;
            background: linear-gradient(135deg, #F5A623, #FBBF47);
            color: #1b1b18;
            border: none;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 16px rgba(245, 166, 35, 0.3);
            transition: all 0.2s;
        }

        .btn-submit-amber:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(245, 166, 35, 0.4);
        }

        /* toast */
        #toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 999;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(16px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            pointer-events: none;
        }

        #toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        #toast.success {
            background: #1b1b18;
            color: white;
        }

        /* avatar colors */
        .av-0 {
            background: linear-gradient(135deg, #F5A623, #D48A10);
        }

        .av-1 {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }

        .av-2 {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .av-3 {
            background: linear-gradient(135deg, #8B5CF6, #6D28D9);
        }

        .av-4 {
            background: linear-gradient(135deg, #EF4444, #DC2626);
        }

        .av-5 {
            background: linear-gradient(135deg, #EC4899, #BE185D);
        }

        /* reveal */
        [data-reveal] {
            opacity: 0;
            transform: translateY(14px);
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        [data-reveal].visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">

                <!-- ════ LEFT SIDEBAR ════ -->
                <div class="col-span-12 lg:col-span-4 space-y-4">

                    <!-- Credit card -->
                    <div class="balance-card green" data-reveal>
                        <div class="balance-bg-icon">
                            <svg width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#10B981"
                                stroke-width="1">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                                <polyline points="17 6 23 6 23 12" />
                            </svg>
                        </div>
                        <p
                            style="font-size:10px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:8px;">
                            Crédit total
                        </p>
                        <p style="font-size:32px;font-weight:300;color:#10B981;line-height:1;">
                            {{ number_format($myCredits, 2) }}
                            <span style="font-size:13px;font-weight:600;color:#a0c8b8;">MAD</span>
                        </p>
                    </div>

                    <!-- Debt card -->
                    <div class="balance-card rose" data-reveal style="transition-delay:0.06s;">
                        <div class="balance-bg-icon">
                            <svg width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#F43F5E"
                                stroke-width="1">
                                <polyline points="23 18 13.5 8.5 8.5 13.5 1 6" />
                                <polyline points="17 18 23 18 23 12" />
                            </svg>
                        </div>
                        <p
                            style="font-size:10px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:8px;">
                            Dette totale
                        </p>
                        <p style="font-size:32px;font-weight:300;color:#F43F5E;line-height:1;">
                            {{ number_format($myDebts, 2) }}
                            <span style="font-size:13px;font-weight:600;color:#c0a0a8;">MAD</span>
                        </p>
                    </div>

                    <!-- Net balance pill -->
                    @php $net = $myCredits - $myDebts; @endphp
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;background:{{ $net >= 0 ? '#ECFDF5' : '#FFF1F2' }};border:1px solid {{ $net >= 0 ? '#A7F3D0' : '#FECDD3' }};border-radius:14px;"
                        data-reveal style="transition-delay:0.1s;">
                        <span
                            style="font-size:10px;font-weight:700;color:{{ $net >= 0 ? '#065F46' : '#9F1239' }};text-transform:uppercase;letter-spacing:0.1em;">Solde
                            net</span>
                        <span
                            style="font-size:18px;font-weight:800;font-family:'Courier New',monospace;color:{{ $net >= 0 ? '#10B981' : '#F43F5E' }};">
                            {{ $net >= 0 ? '+' : '' }}{{ number_format($net, 2) }} MAD
                        </span>
                    </div>

                    <!-- Members card -->
                    <div class="side-card" data-reveal style="transition-delay:0.14s;">
                        <div class="side-card-accent" style="background:linear-gradient(90deg,#F5A623,#FBBF47);">
                        </div>
                        <div
                            style="padding:16px 20px 10px;display:flex;align-items:center;justify-content:space-between;">
                            <h3
                                style="font-size:11px;font-weight:800;color:#1b1b18;text-transform:uppercase;letter-spacing:0.12em;">
                                Membres
                            </h3>
                            <span
                                style="font-size:10px;font-weight:700;background:#f5f5f2;padding:3px 9px;border-radius:99px;color:#888;">
                                {{ $colocation->members->count() }}
                            </span>
                        </div>
                        <div>
                            @foreach ($colocation->members as $i => $member)
                                <div class="member-row">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="member-av av-{{ $i % 6 }}">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="font-size:13px;font-weight:700;color:#1b1b18;line-height:1.2;">
                                                {{ $member->name }}</p>
                                            <p
                                                style="font-size:10px;color:#bbb;text-transform:uppercase;letter-spacing:0.08em;margin-top:2px;">
                                                {{ $member->pivot->role }}
                                                @if ($member->id === auth()->id())
                                                    &nbsp;·&nbsp; <span style="color:#F5A623;">Moi</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if ($colocation->members()->where('user_id', auth()->id())->where('role', 'admin')->exists() && $member->id !== auth()->id())
                                        <form action="{{ route('colocations.members.kick', [$colocation, $member]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Exclure {{ $member->name }} de la coloc ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kick-btn">
                                                <svg width="10" height="10" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <path d="M16 17 L21 12 L16 7" />
                                                    <line x1="21" y1="12" x2="9"
                                                        y2="12" />
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                                </svg>
                                                Exclure
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- ════ TRANSACTIONS PANEL ════ -->
                <div class="col-span-12 lg:col-span-8" data-reveal style="transition-delay:0.08s;">
                    <div class="side-card">
                        <div class="side-card-accent" style="background:linear-gradient(90deg,#1b1b18,#2d2d28);">
                        </div>

                        <!-- Panel header -->
                        <div
                            style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f0f0ec;">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div
                                    style="width:3px;height:16px;background:linear-gradient(180deg,#F5A623,#FBBF47);border-radius:3px;">
                                </div>
                                <h3
                                    style="font-size:11px;font-weight:800;color:#1b1b18;text-transform:uppercase;letter-spacing:0.12em;">
                                    Historique des transactions
                                </h3>
                            </div>
                            <span
                                style="font-size:10px;font-weight:700;background:#f5f5f2;padding:3px 9px;border-radius:99px;color:#888;">
                                {{ $colocation->transactions->count() }}
                                entrée{{ $colocation->transactions->count() !== 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Table -->
                        <div style="overflow-x:auto;">
                            @if ($colocation->transactions->isEmpty())
                                <div class="tx-empty">
                                    <div class="tx-empty-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="#F5A623" stroke-width="1.5">
                                            <line x1="12" y1="1" x2="12" y2="23" />
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                        </svg>
                                    </div>
                                    <p
                                        style="font-size:11px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:0.2em;margin-bottom:6px;">
                                        Aucune transaction
                                    </p>
                                    <p style="font-size:13px;color:#ccc;">Ajoute la première dépense de ta coloc.</p>
                                </div>
                            @else
                                <table class="tx-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Payé par</th>
                                            <th>Type</th>
                                            <th>Montant</th>
                                            <th style="text-align:right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($colocation->transactions as $transaction)
                                            <tr>
                                                <!-- Description -->
                                                <td>
                                                    <p
                                                        style="font-size:13px;font-weight:600;color:#1b1b18;margin-bottom:2px;">
                                                        {{ $transaction->description }}
                                                    </p>
                                                    <p
                                                        style="font-size:10px;color:#ccc;font-family:'Courier New',monospace;">
                                                        {{ $transaction->created_at->format('d M Y') }}
                                                    </p>
                                                </td>

                                                <!-- Payer -->
                                                <td>
                                                    <div style="display:flex;align-items:center;gap:7px;">
                                                        <div
                                                            style="width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,#F5A623,#D48A10);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;color:white;flex-shrink:0;">
                                                            {{ strtoupper(substr($transaction->payer->name, 0, 1)) }}
                                                        </div>
                                                        <span style="font-size:13px;color:#555;font-weight:500;">
                                                            {{ $transaction->payer->name }}
                                                            @if ($transaction->payer_id === auth()->id())
                                                                <span
                                                                    style="font-size:9px;color:#F5A623;font-weight:700;">(moi)</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </td>

                                                <!-- Type -->
                                                <td>
                                                    <span
                                                        class="type-badge {{ $transaction->type === 'shared' ? 'type-shared' : 'type-p2p' }}">
                                                        @if ($transaction->type === 'shared')
                                                            <svg width="8" height="8" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor"
                                                                stroke-width="2.5">
                                                                <circle cx="18" cy="5" r="3" />
                                                                <circle cx="6" cy="12" r="3" />
                                                                <circle cx="18" cy="19" r="3" />
                                                                <line x1="8.59" y1="13.51" x2="15.42"
                                                                    y2="17.49" />
                                                                <line x1="15.41" y1="6.51" x2="8.59"
                                                                    y2="10.49" />
                                                            </svg>
                                                            Partagé
                                                        @else
                                                            <svg width="8" height="8" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor"
                                                                stroke-width="2.5">
                                                                <line x1="5" y1="12" x2="19"
                                                                    y2="12" />
                                                                <polyline points="12 5 19 12 12 19" />
                                                            </svg>
                                                            P2P
                                                        @endif
                                                    </span>
                                                </td>

                                                <!-- Amount -->
                                                <td>
                                                    <p
                                                        style="font-size:14px;font-weight:800;font-family:'Courier New',monospace;color:{{ $transaction->payer_id == auth()->id() ? '#10B981' : '#1b1b18' }};">
                                                        {{ $transaction->payer_id == auth()->id() ? '+' : '' }}{{ number_format($transaction->amount, 2) }}
                                                    </p>
                                                    <p
                                                        style="font-size:9px;color:#ccc;text-transform:uppercase;letter-spacing:0.1em;">
                                                        MAD</p>
                                                </td>

                                                <!-- Action -->
                                                <td style="text-align:right;">
                                                    @if ($transaction->payer_id === auth()->id())
                                                        <form
                                                            action="{{ route('transactions.destroy', [$colocation, $transaction]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Supprimer cette transaction ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="del-btn">
                                                                <svg width="10" height="10"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2.5">
                                                                    <polyline points="3 6 5 6 21 6" />
                                                                    <path
                                                                        d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                                    <path d="M10 11v6" />
                                                                    <path d="M14 11v6" />
                                                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                                </svg>
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span style="color:#e0e0e0;font-size:12px;">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ════════ MODAL: NOUVELLE TRANSACTION ════════ -->
    <div id="addTransactionModal" class="modal-hidden">
        <div class="modal-wrap">
            <div class="modal-overlay" onclick="closeModal('addTransactionModal')"></div>
            <div class="modal-box">
                <div class="modal-top-bar"></div>
                <div class="modal-inner">
                    <div class="modal-header">
                        <div class="modal-title-wrap">
                            <div class="modal-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="#F5A623" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </div>
                            <span class="modal-title">Nouvelle transaction</span>
                        </div>
                        <button class="modal-close" onclick="closeModal('addTransactionModal')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('transactions.store', $colocation) }}">
                        @csrf

                        <!-- Description -->
                        <div style="margin-bottom:16px;">
                            <label class="field-label">Description</label>
                            <input type="text" name="description" required class="field-input"
                                placeholder="Ex: Facture Redal, Courses Marjane...">
                        </div>

                        <!-- Amount -->
                        <div style="margin-bottom:16px;">
                            <label class="field-label">Montant (MAD)</label>
                            <div style="position:relative;">
                                <input type="number" step="0.01" min="0.01" name="amount" required
                                    class="field-input" style="padding-right:52px;" placeholder="0.00">
                                <span
                                    style="position:absolute;right:14px;top:50%;transform:translateY(-50%);font-size:12px;font-weight:700;color:#bbb;pointer-events:none;">MAD</span>
                            </div>
                        </div>

                        <!-- Type selector -->
                        <div style="margin-bottom:16px;">
                            <label class="field-label">Type de transaction</label>
                            <div class="type-selector">
                                <label class="type-option selected" id="opt-shared" onclick="selectType('shared')">
                                    <input type="radio" name="type" value="shared" checked
                                        style="display:none;">
                                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:3px;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="#F5A623" stroke-width="2">
                                            <circle cx="18" cy="5" r="3" />
                                            <circle cx="6" cy="12" r="3" />
                                            <circle cx="18" cy="19" r="3" />
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                                        </svg>
                                        <span class="type-option-title">Partagé</span>
                                    </div>
                                    <p class="type-option-sub">Divisé entre tous les membres</p>
                                </label>
                                <label class="type-option" id="opt-p2p" onclick="selectType('p2p')">
                                    <input type="radio" name="type" value="p2p" style="display:none;">
                                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:3px;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="#0369A1" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                            <polyline points="12 5 19 12 12 19" />
                                        </svg>
                                        <span class="type-option-title">P2P</span>
                                    </div>
                                    <p class="type-option-sub">Prêt entre 2 personnes</p>
                                </label>
                            </div>
                        </div>

                        <!-- Receiver (P2P only) -->
                        <div id="receiverContainer" style="display:none;margin-bottom:16px;">
                            <label class="field-label">Bénéficiaire</label>
                            <select name="receiver_id" class="field-input">
                                @foreach ($colocation->members as $member)
                                    @if ($member->id !== auth()->id())
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div style="display:flex;gap:10px;margin-top:24px;">
                            <button type="button" class="btn-cancel"
                                onclick="closeModal('addTransactionModal')">Annuler</button>
                            <button type="submit" class="btn-submit-amber">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <span id="toastMsg"></span>
    </div>

    <script>
        // ── Modal ──
        function openModal(id) {
            document.getElementById(id).classList.remove('modal-hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('modal-hidden');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal('addTransactionModal');
        });

        // ── Type selector ──
        function selectType(type) {
            document.getElementById('opt-shared').classList.toggle('selected', type === 'shared');
            document.getElementById('opt-p2p').classList.toggle('selected', type === 'p2p');
            document.getElementById('receiverContainer').style.display = type === 'p2p' ? 'block' : 'none';
            document.querySelector(`input[value="${type}"]`).checked = true;
        }

        // ── Copy code ──
        function copyCode() {
            const code = document.getElementById('invitationCode').innerText.trim();
            navigator.clipboard.writeText(code).then(() => showToast('Code copié : ' + code));
        }

        // ── Toast ──
        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').textContent = msg;
            t.className = 'show success';
            setTimeout(() => {
                t.className = '';
            }, 2800);
        }

        // ── Scroll reveal ──
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('[data-reveal]').forEach(el => obs.observe(el));
    </script>

</x-app-layout>
