<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HS - Dashboard</title>

    <!-- Fonts (Plus Jakarta Sans for Finance Look) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-[#0f172a] text-slate-200">
    <!-- Toast Notification System -->
    <div x-data="{
        show: false,
        message: '',
        type: 'success',
        init() {
            @if (session('success')) this.showToast('{{ session('success') }}', 'success');
                    @elseif(session('error'))
                        this.showToast('{{ session('error') }}', 'error'); @endif
        },
        showToast(msg, type) {
            this.message = msg;
            this.type = type;
            this.show = true;
            setTimeout(() => { this.show = false }, 4000);
        }
    }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
        class="fixed top-5 right-5 z-[100] min-w-[300px]" style="display: none;">
        <div :class="type === 'success' ? 'bg-emerald-500/10 border-emerald-500/50 text-emerald-400' :
            'bg-rose-500/10 border-rose-500/50 text-rose-400'"
            class="backdrop-blur-xl border px-6 py-4 rounded-2xl shadow-2xl flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Icon Success -->
                <template x-if="type === 'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                <!-- Icon Error -->
                <template x-if="type === 'error'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                <span class="text-sm font-bold" x-text="message"></span>
            </div>
            <button @click="show = false" class="ml-4 opacity-70 hover:opacity-100 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div class="min-h-screen bg-transparent">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-slate-900/50 border-b border-slate-800 backdrop-blur-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
