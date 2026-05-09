<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center shadow-sm">
                            <span class="text-white font-bold text-sm">HS</span>
                        </div>
                        <span class="text-[#1b1b18] font-bold tracking-widest text-sm hidden md:block uppercase">Hsab Sabon</span>
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-xs font-bold uppercase tracking-widest transition
                              {{ request()->routeIs('dashboard')
                                  ? 'border-amber-400 text-[#1b1b18]'
                                  : 'border-transparent text-gray-400 hover:text-[#1b1b18]' }}">
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Desktop User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative">
                    <button id="user-menu-button"
                            class="flex items-center gap-2 text-gray-500 hover:text-[#1b1b18] transition focus:outline-none">
                        <div class="text-right">
                            <p class="text-[10px] font-bold uppercase leading-none text-[#1b1b18]">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-gray-400 font-mono italic">Account</p>
                        </div>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="user-dropdown"
                         class="hidden absolute right-0 z-50 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl py-1 overflow-hidden">
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2.5 text-xs font-bold text-gray-500 hover:bg-gray-50 hover:text-[#1b1b18] uppercase tracking-widest transition">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-xs font-bold text-rose-500 hover:bg-rose-50 uppercase tracking-widest transition border-t border-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Toggle -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button id="mobile-toggle" class="p-2 text-gray-400 hover:text-[#1b1b18] focus:outline-none transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block pl-3 pr-4 py-2 border-l-4 text-xs font-bold uppercase transition
                      {{ request()->routeIs('dashboard')
                          ? 'border-amber-400 bg-amber-50 text-[#1b1b18]'
                          : 'border-transparent text-gray-400 hover:text-[#1b1b18]' }}">
                Dashboard
            </a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-100">
            <div class="px-4 py-2">
                <div class="text-xs font-bold text-[#1b1b18] uppercase">{{ Auth::user()->name }}</div>
                <div class="text-[10px] text-gray-400 font-mono">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-xs font-bold text-gray-500 hover:text-[#1b1b18] uppercase transition">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 text-xs font-bold text-rose-500 uppercase transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userBtn      = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu   = document.getElementById('mobile-menu');
        const navIcon      = document.getElementById('nav-icon');

        if (userBtn) {
            userBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.toggle('hidden');
                navIcon.innerHTML = isHidden
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            });
        }

        document.addEventListener('click', function () {
            if (userDropdown) userDropdown.classList.add('hidden');
        });
    });
</script>