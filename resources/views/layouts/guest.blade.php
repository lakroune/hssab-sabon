<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HS - Hsab Sabon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0f172a] text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-900 via-slate-900 to-black">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white">
                HS<span class="text-blue-500">.</span>
            </h1>
            <p class="text-slate-400 text-sm mt-2">Manage your shared expenses smarter.</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-slate-800/50 backdrop-blur-xl border border-slate-700 shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>
</html>