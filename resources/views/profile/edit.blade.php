<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white uppercase tracking-widest">
                    {{ __('User Profile') }}
                </h2>
                <p class="text-slate-500 text-[10px] font-mono mt-1 italic uppercase">Settings & Security</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-1">
            
            <!-- Section 1: Account Info (Read Only) -->
            <div class="bg-slate-900 p-8">
                <div class="max-w-xl">
                    <h3 class="text-white text-sm font-bold uppercase tracking-widest mb-2">Account Information</h3>
                    <p class="text-slate-600 text-xs mb-6">These details are managed by the system and cannot be changed.</p>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Full Name</label>
                            <div class="w-full bg-slate-950 text-slate-400 px-4 py-3 cursor-not-allowed">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Email Address</label>
                            <div class="w-full bg-slate-950 text-slate-400 px-4 py-3 cursor-not-allowed font-mono">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Update Password -->
            <div class="bg-slate-900 p-8">
                <div class="max-w-xl">
                    <h3 class="text-white text-sm font-bold uppercase tracking-widest mb-2">Update Password</h3>
                    <p class="text-slate-600 text-xs mb-6">Ensure your account is using a long, random password to stay secure.</p>
                    
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full bg-slate-950 text-white px-4 py-3 outline-none focus:ring-1 focus:ring-blue-600 transition">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">New Password</label>
                            <input type="password" name="password" class="w-full bg-slate-950 text-white px-4 py-3 outline-none focus:ring-1 focus:ring-blue-600 transition">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full bg-slate-950 text-white px-4 py-3 outline-none focus:ring-1 focus:ring-blue-600 transition">
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 text-xs font-bold transition uppercase tracking-widest">
                                Save Changes
                            </button>
                            @if (session('status') === 'password-updated')
                                <p class="text-emerald-500 text-[10px] font-bold uppercase">Saved.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section 3: System Note -->
            <div class="bg-slate-900/50 p-8">
                <div class="max-w-xl">
                    <h3 class="text-rose-600 text-sm font-bold uppercase tracking-widest mb-2">Support</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Account deletion is restricted. To deactivate access, contact the system administrator.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>