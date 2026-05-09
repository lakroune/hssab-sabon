<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-[#1b1b18] uppercase tracking-widest">
                    {{ __('User Profile') }}
                </h2>
                <p class="text-gray-400 text-[10px] font-mono mt-1 italic uppercase">Settings & Security</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

            <!-- Section 1: Account Info (Read Only) -->
            <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                <div class="max-w-xl">
                    <h3 class="text-[#1b1b18] text-sm font-bold uppercase tracking-widest mb-1">Account Information</h3>
                    <p class="text-gray-400 text-xs mb-6">These details are managed by the system and cannot be changed.</p>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Full Name</label>
                            <div class="w-full bg-gray-50 border border-gray-100 text-gray-400 px-4 py-3 rounded-xl cursor-not-allowed text-sm">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                            <div class="w-full bg-gray-50 border border-gray-100 text-gray-400 px-4 py-3 rounded-xl cursor-not-allowed font-mono text-sm">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Update Password -->
            <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                <div class="max-w-xl">
                    <h3 class="text-[#1b1b18] text-sm font-bold uppercase tracking-widest mb-1">Update Password</h3>
                    <p class="text-gray-400 text-xs mb-6">Ensure your account is using a long, random password to stay secure.</p>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Current Password</label>
                            <input type="password" name="current_password"
                                   class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                          focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">New Password</label>
                            <input type="password" name="password"
                                   class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                          focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                          focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="bg-amber-400 hover:bg-amber-300 text-[#1b1b18] px-8 py-3 text-xs font-bold transition uppercase tracking-widest rounded-xl shadow-md shadow-amber-200/50">
                                Save Changes
                            </button>
                            @if (session('status') === 'password-updated')
                                <p class="text-emerald-500 text-[10px] font-bold uppercase tracking-wider">✓ Saved.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section 3: Support Note -->
            <div class="bg-rose-50 border border-rose-100 rounded-2xl p-8">
                <div class="max-w-xl">
                    <h3 class="text-rose-500 text-sm font-bold uppercase tracking-widest mb-1">Support</h3>
                    <p class="text-rose-400 text-xs leading-relaxed">
                        Account deletion is restricted. To deactivate access, contact the system administrator.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>