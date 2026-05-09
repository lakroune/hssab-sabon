<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HS - Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FDFDFC] text-[#1b1b18]">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <!-- Background blobs — same as welcome hero -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-100 rounded-full blur-3xl opacity-40 -translate-y-1/3 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-amber-50 rounded-full blur-3xl opacity-50 translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>

        <!-- Logo / Brand -->
        <div class="mb-8 text-center relative z-10">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                <div class="w-10 h-10 bg-amber-400 rounded-lg flex items-center justify-center shadow-sm">
                    <span class="text-white font-bold text-xl">HS</span>
                </div>
                <span class="font-semibold text-lg tracking-tight uppercase text-[#1b1b18]">Hsab Sabon</span>
            </a>
            <p class="text-gray-500 text-sm mt-3">Manage your shared expenses smarter.</p>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md relative z-10 px-8 py-10 bg-white border border-gray-100 shadow-2xl shadow-gray-200/60 overflow-hidden sm:rounded-3xl">
            {{ $slot }}
        </div>

        <!-- Footer note -->
        <p class="mt-8 text-xs text-gray-400 relative z-10">
            &copy; {{ date('Y') }} Hsab Sabon — by Ismail Lakroune
        </p>

    </div>
</body>
</html>