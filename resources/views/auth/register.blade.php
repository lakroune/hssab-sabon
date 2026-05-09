<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-[#1b1b18] mb-2">Full Name</label>
            <input id="name"
                   type="text"
                   name="name"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   value="{{ old('name') }}"
                   required autofocus
                   placeholder="John Doe"
                   autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#1b1b18] mb-2">Email Address</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   value="{{ old('email') }}"
                   required
                   placeholder="name@company.com"
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-[#1b1b18] mb-2">Password</label>
            <input id="password"
                   type="password"
                   name="password"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   required
                   placeholder="••••••••"
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-[#1b1b18] mb-2">Confirm Password</label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-[#1b1b18] placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                          transition duration-200 shadow-sm"
                   required
                   placeholder="••••••••"
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg shadow-amber-200/50
                           text-sm font-bold text-[#1b1b18] bg-amber-400 hover:bg-amber-300
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400
                           transition-all duration-200 transform hover:scale-[1.02]">
                Create Account
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#1b1b18] font-bold hover:text-amber-600 transition">
                    Sign In
                </a>
            </p>
        </div>

    </form>
</x-guest-layout>