<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                   value="{{ old('email') }}" 
                   required autofocus 
                   placeholder="name@company.com"
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="text-sm font-semibold text-slate-300">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-400 hover:text-blue-300 transition" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                   required 
                   placeholder="••••••••"
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-800" name="remember">
            <span class="ms-2 text-sm text-slate-400">Keep me logged in</span>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02]">
                Sign In
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-slate-400">
                New member? 
                <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:underline">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>