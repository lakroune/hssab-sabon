<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Financial Overview') }}
            </h2>
            <div class="flex gap-3">
                <button @click="$dispatch('open-modal', 'join-coloc')" class="bg-slate-800 hover:bg-slate-700 text-white px-4 py-2 rounded-xl border border-slate-700 transition shadow-lg text-sm font-semibold">
                    + Join Coloc
                </button>
                <button @click="$dispatch('open-modal', 'create-coloc')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition shadow-lg shadow-blue-500/20 text-sm font-semibold">
                    Create New
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-blue-100 mt-2">You are currently active in {{ $colocations->count() }} colocations.</p>
                </div>
                <!-- Abstract Design Shape -->
                <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Colocations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($colocations as $coloc)
                    <a href="{{ route('colocations.show', $coloc) }}" class="group bg-slate-800/40 backdrop-blur-md border border-slate-700/50 p-6 rounded-3xl hover:border-blue-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-blue-500/10 rounded-2xl">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold tracking-widest uppercase bg-slate-700 px-2 py-1 rounded-md text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition">
                                {{ $coloc->pivot->role }}
                            </span>
                        </div>
                        
                        <h4 class="text-xl font-bold text-white mb-1">{{ $coloc->name }}</h4>
                        <p class="text-slate-400 text-xs mb-6 font-mono tracking-tighter">ID: {{ $coloc->invitation_code }}</p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                            <div>
                                <p class="text-slate-500 text-[10px] uppercase font-bold">Members</p>
                                <p class="text-white font-semibold">{{ $coloc->members->count() }} People</p>
                            </div>
                            <div class="text-right">
                                <p class="text-slate-500 text-[10px] uppercase font-bold">Balance</p>
                                <p class="text-emerald-400 font-bold">Active</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center bg-slate-800/20 border-2 border-dashed border-slate-700 rounded-3xl">
                        <p class="text-slate-500 italic">No colocations found. Create one to get started!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    <x-modal name="create-coloc" focusable>
        <form method="post" action="{{ route('colocations.store') }}" class="p-8 bg-slate-900">
            @csrf
            <h2 class="text-lg font-bold text-white mb-4">Start New Colocation</h2>
            <input type="text" name="name" placeholder="E.g. Appartement 5, Résidence Al Amal" class="w-full bg-slate-800 border-slate-700 rounded-xl text-white mb-4 focus:ring-blue-500">
            <div class="flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold">Create</button>
            </div>
        </form>
    </x-modal>

    <!-- Modal Join -->
    <x-modal name="join-coloc" focusable>
        <form method="post" action="{{ route('colocations.join') }}" class="p-8 bg-slate-900">
            @csrf
            <h2 class="text-lg font-bold text-white mb-4">Join Colocation</h2>
            <p class="text-slate-400 text-sm mb-4">Enter the invitation code provided by the owner.</p>
            <input type="text" name="invitation_code" placeholder="CODE123" class="w-full bg-slate-800 border-slate-700 rounded-xl text-white mb-4 focus:ring-blue-500 uppercase">
            <div class="flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold">Join</button>
            </div>
        </form>
    </x-modal>
</x-app-layout>