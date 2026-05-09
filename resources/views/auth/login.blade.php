<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#1b1b18] mb-2">
                Email Address
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   value="{{ old('email') }}"
                   required autofocus
                   placeholder="name@company.com"
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="text-sm font-semibold text-[#1b1b18]">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-amber-600 hover:text-amber-500 font-medium transition"
                       href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password"
                   type="password"
                   name="password"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   required
                   placeholder="••••••••"
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me"
                   type="checkbox"
                   class="w-4 h-4 rounded border-gray-300 bg-white text-amber-500 focus:ring-amber-400 focus:ring-offset-white"
                   name="remember">
            <span class="ms-2 text-sm text-gray-500">Keep me logged in</span>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg shadow-amber-200/50
                           text-sm font-bold text-[#1b1b18] bg-amber-400 hover:bg-amber-300
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400
                           transition-all duration-200 transform hover:scale-[1.02]">
                Sign In
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                New member?
                <a href="{{ route('register') }}"
                   class="text-[#1b1b18] font-bold hover:text-amber-600 transition">
                    Create an account
                </a>
            </p>
        </div>

    </form>
</x-guest-layout>