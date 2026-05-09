<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HS - Hsab Sabon</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        .modal-hidden { display: none !important; }
        .toast-hidden { opacity: 0; transform: translateY(-20px); pointer-events: none; }
        .toast-visible { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-[#FDFDFC] text-[#1b1b18]">

    <!-- Toast Notification -->
    <div id="toastContainer"
         class="fixed top-5 right-5 z-[200] min-w-[300px] transition-all duration-300 toast-hidden">
        <div id="toastBox"
             class="rounded-2xl border px-6 py-4 shadow-xl flex items-center justify-between border-l-4">
            <span id="toastMessage" class="text-sm font-bold uppercase tracking-wider"></span>
            <button onclick="hideToast()" class="ml-4 opacity-60 hover:opacity-100 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white border-b border-gray-100 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        function openModal(id) {
            const m = document.getElementById(id);
            if (m) {
                m.classList.remove('modal-hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(id) {
            const m = document.getElementById(id);
            if (m) {
                m.classList.add('modal-hidden');
                document.body.style.overflow = 'auto';
            }
        }

        window.onclick = function(e) {
            if (e.target.classList.contains('modal-overlay')) {
                e.target.parentElement.classList.add('modal-hidden');
                document.body.style.overflow = 'auto';
            }
        }

        function showToast(msg, type = 'success') {
            const container = document.getElementById('toastContainer');
            const box      = document.getElementById('toastBox');
            const message  = document.getElementById('toastMessage');

            message.innerText = msg;

            if (type === 'success') {
                box.className = 'rounded-2xl border px-6 py-4 shadow-xl flex items-center justify-between border-l-4 bg-emerald-50 border-emerald-400 text-emerald-700';
            } else {
                box.className = 'rounded-2xl border px-6 py-4 shadow-xl flex items-center justify-between border-l-4 bg-rose-50 border-rose-400 text-rose-600';
            }

            container.classList.remove('toast-hidden');
            container.classList.add('toast-visible');

            setTimeout(() => { hideToast(); }, 4000);
        }

        function hideToast() {
            const container = document.getElementById('toastContainer');
            container.classList.remove('toast-visible');
            container.classList.add('toast-hidden');
        }

        window.onload = function() {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        }
    </script>
</body>
</html>