<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HS - System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        * { border-radius: 0 !important; }
        .modal-hidden { display: none !important; }
        .toast-hidden { opacity: 0; transform: translateY(-20px); pointer-events: none; }
        .toast-visible { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-[#0f172a] text-slate-200">

    <div id="toastContainer" class="fixed top-5 right-5 z-[200] min-w-[300px] transition-all duration-300 toast-hidden">
        <div id="toastBox" class="backdrop-blur-xl border px-6 py-4 shadow-2xl flex items-center justify-between border-l-4">
            <div class="flex items-center gap-3">
                <span id="toastMessage" class="text-sm font-bold uppercase tracking-wider"></span>
            </div>
            <button onclick="hideToast()" class="ml-4 opacity-70 hover:opacity-100">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path></svg>
            </button>
        </div>
    </div>

    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-slate-900/50 border-b border-slate-800 backdrop-blur-md">
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
            if(m) {
                m.classList.remove('modal-hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(id) {
            const m = document.getElementById(id);
            if(m) {
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
            const box = document.getElementById('toastBox');
            const message = document.getElementById('toastMessage');

            message.innerText = msg;
            
            if(type === 'success') {
                box.className = 'backdrop-blur-xl border px-6 py-4 shadow-2xl flex items-center justify-between border-l-4 bg-emerald-500/10 border-emerald-500/50 text-emerald-400';
            } else {
                box.className = 'backdrop-blur-xl border px-6 py-4 shadow-2xl flex items-center justify-between border-l-4 bg-rose-500/10 border-rose-500/50 text-rose-400';
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