<x-app-layout>
    <div x-data="{ showCreate: false, showJoin: false }">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-white uppercase tracking-[0.2em]">
                    Financial Control Center
                </h2>
                <div class="flex gap-2">
                    <button @click="showJoin = true" class="bg-slate-800 hover:bg-slate-700 text-white px-6 py-2 text-xs font-bold transition border border-slate-700">
                        JOIN COLOCATION
                    </button>
                    <button @click="showCreate = true" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 text-xs font-bold transition">
                        CREATE NEW
                    </button>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                
                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
                    <div class="bg-slate-900 p-8 border-l-4 border-blue-600 shadow-2xl">
                        <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase">Active Units</p>
                        <p class="text-4xl font-light text-white mt-2">{{ $colocations->count() }}</p>
                    </div>
                    <div class="bg-slate-900 p-8 border-l-4 border-emerald-600 shadow-2xl">
                        <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase">Total Credit</p>
                        <p class="text-4xl font-light text-emerald-500 mt-2">Active</p>
                    </div>
                    <div class="bg-slate-900 p-8 border-l-4 border-rose-600 shadow-2xl">
                        <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase">Pending Debts</p>
                        <p class="text-4xl font-light text-rose-500 mt-2">Calculated</p>
                    </div>
                </div>

                <!-- Colocations List -->
                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <h3 class="text-white text-xs font-bold tracking-[0.3em] uppercase">My Colocations</h3>
                        <div class="flex-grow h-[1px] bg-slate-800"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($colocations as $coloc)
                            <div class="bg-slate-900 border border-slate-800 hover:border-blue-600 transition-colors group">
                                <div class="p-8">
                                    <div class="flex justify-between items-start mb-6">
                                        <div class="text-blue-500">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <span class="text-[9px] font-black tracking-tighter bg-blue-600 text-white px-2 py-1 uppercase italic">
                                            {{ $coloc->pivot->role }}
                                        </span>
                                    </div>
                                    
                                    <h4 class="text-lg font-bold text-white uppercase tracking-wider">{{ $coloc->name }}</h4>
                                    <p class="text-slate-500 text-[10px] font-mono mt-1">ID: {{ $coloc->invitation_code }}</p>

                                    <div class="mt-8 pt-6 border-t border-slate-800 flex justify-between items-center">
                                        <div class="flex -space-x-2">
                                            @foreach($coloc->members->take(3) as $member)
                                                <div class="w-7 h-7 bg-slate-700 border border-slate-900 text-[10px] flex items-center justify-center font-bold text-slate-300 uppercase">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <a href="{{ route('colocations.show', $coloc) }}" class="text-[10px] font-bold text-white uppercase border-b border-blue-600 pb-1 hover:text-blue-500 transition">
                                            Open Ledger
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full border border-dashed border-slate-800 p-20 text-center">
                                <p class="text-slate-600 text-xs font-bold uppercase tracking-widest">No Active Colocations Registered</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Modal: Create Colocation -->
        <div x-show="showCreate" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-sm" @click="showCreate = false"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-slate-900 border border-slate-800 w-full max-w-md p-10 shadow-2xl" @click.stop>
                    <form method="post" action="{{ route('colocations.store') }}">
                        @csrf
                        <h2 class="text-sm font-bold text-white uppercase tracking-[0.2em] mb-8 text-center border-b border-slate-800 pb-4">Initialize Colocation</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Identification Name</label>
                                <input type="text" name="name" required class="w-full bg-slate-950 border-slate-800 text-white text-sm focus:ring-0 focus:border-blue-600 transition px-4 py-3 border">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" @click="showCreate = false" class="w-1/3 border border-slate-800 text-slate-400 py-4 text-xs font-bold uppercase hover:bg-slate-800 transition">Cancel</button>
                                <button type="submit" class="w-2/3 bg-blue-600 text-white py-4 text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Manual Modal: Join Colocation -->
        <div x-show="showJoin" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-sm" @click="showJoin = false"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-slate-900 border border-slate-800 w-full max-w-md p-10 shadow-2xl" @click.stop>
                    <form method="post" action="{{ route('colocations.join') }}">
                        @csrf
                        <h2 class="text-sm font-bold text-white uppercase tracking-[0.2em] mb-8 text-center border-b border-slate-800 pb-4">Sync Invitation Code</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Access Token</label>
                                <input type="text" name="invitation_code" required class="w-full bg-slate-950 border-slate-800 text-white text-sm focus:ring-0 focus:border-blue-600 transition px-4 py-3 border uppercase font-mono">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" @click="showJoin = false" class="w-1/3 border border-slate-800 text-slate-400 py-4 text-xs font-bold uppercase hover:bg-slate-800 transition">Cancel</button>
                                <button type="submit" class="w-2/3 bg-blue-600 text-white py-4 text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition">Join Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>