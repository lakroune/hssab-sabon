<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-[#1b1b18] uppercase tracking-[0.2em]">
                    My Colocations
                </h2>
                <p class="text-gray-400 text-[9px] font-mono mt-1 italic uppercase tracking-wider">
                    User ID: {{ auth()->id() }} // Session Active
                </p>
            </div>
            <div class="flex gap-2">
                <button onclick="openModal('modalJoin')"
                        class="bg-white hover:bg-gray-50 text-[#1b1b18] px-6 py-2 text-xs font-bold transition border border-gray-200 uppercase tracking-widest rounded-lg shadow-sm">
                    Join Coloc
                </button>
                <button onclick="openModal('modalCreate')"
                        class="bg-amber-400 hover:bg-amber-300 text-[#1b1b18] px-6 py-2 text-xs font-bold transition uppercase tracking-widest rounded-lg shadow-md shadow-amber-200/50">
                    Create Coloc
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm border-l-4 border-l-amber-400">
                    <p class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Active Colocs</p>
                    <p class="text-3xl font-light text-[#1b1b18] mt-2">{{ $colocations->count() }}</p>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm border-l-4 border-l-emerald-400">
                    <p class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Total Credit</p>
                    <p class="text-3xl font-bold text-emerald-500 mt-2">
                        {{ number_format($totalCredits, 2) }}
                        <span class="text-xs font-normal text-gray-400">MAD</span>
                    </p>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm border-l-4 border-l-rose-400">
                    <p class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Total Debt</p>
                    <p class="text-3xl font-bold text-rose-500 mt-2">
                        {{ number_format($totalDebts, 2) }}
                        <span class="text-xs font-normal text-gray-400">MAD</span>
                    </p>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm border-l-4 border-l-amber-400">
                    <p class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Net Balance</p>
                    <p class="text-3xl font-mono {{ ($totalCredits - $totalDebts) >= 0 ? 'text-emerald-500' : 'text-rose-500' }} mt-2">
                        {{ number_format($totalCredits - $totalDebts, 2) }}
                    </p>
                </div>
            </div>

            <!-- Coloc Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($colocations as $coloc)
                    <div class="bg-white border border-gray-100 rounded-2xl hover:border-amber-300 hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-300 group">
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <span class="text-[9px] font-black bg-amber-100 text-amber-700 px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $coloc->pivot->role ?? 'Member' }}
                                </span>
                            </div>

                            <h4 class="text-lg font-bold text-[#1b1b18] uppercase tracking-wider">{{ $coloc->name }}</h4>
                            <p class="text-gray-400 text-[10px] font-mono mt-1 italic">Code: {{ $coloc->invitation_code }}</p>

                            <div class="mt-8 pt-6 border-t border-gray-50 flex justify-between items-center">
                                <!-- Member Avatars -->
                                <div class="flex -space-x-2">
                                    @foreach($coloc->members->take(4) as $member)
                                        <div title="{{ $member->name }}"
                                             class="w-8 h-8 bg-amber-100 border-2 border-white rounded-full text-[10px] flex items-center justify-center font-bold text-amber-700">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                    @endforeach
                                    @if($coloc->members->count() > 4)
                                        <div class="w-8 h-8 bg-gray-100 border-2 border-white rounded-full text-[9px] flex items-center justify-center text-gray-500 font-bold">
                                            +{{ $coloc->members->count() - 4 }}
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('colocations.show', $coloc) }}"
                                   class="text-[11px] font-bold text-[#1b1b18] uppercase border-b-2 border-amber-400 pb-0.5 hover:text-amber-600 transition">
                                    Open →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full border-2 border-dashed border-gray-200 rounded-3xl p-20 text-center bg-white/50">
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4">🏠</div>
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-[0.4em]">No Colocations Yet</p>
                        <p class="text-gray-400 text-xs mt-2">Create or join a coloc to get started.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal: Create -->
    <div id="modalCreate" class="fixed inset-0 z-[150] modal-hidden">
        <div class="fixed inset-0 bg-[#1b1b18]/60 backdrop-blur-sm modal-overlay" onclick="closeModal('modalCreate')"></div>
        <div class="relative bg-white border border-gray-100 rounded-3xl w-full max-w-md p-10 shadow-2xl mx-auto mt-20">
            <form method="post" action="{{ route('colocations.store') }}">
                @csrf
                <h2 class="text-sm font-bold text-[#1b1b18] uppercase tracking-[0.3em] mb-8 border-b border-gray-100 pb-4">
                    Create a Colocation
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Coloc Name</label>
                        <input type="text" name="name" required
                               class="w-full bg-white border border-gray-200 text-[#1b1b18] text-sm
                                      focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                      transition px-4 py-3 rounded-xl outline-none shadow-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="button" onclick="closeModal('modalCreate')"
                                class="flex-1 bg-gray-100 text-gray-500 py-3 text-xs font-bold uppercase rounded-xl hover:bg-gray-200 transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-[2] bg-amber-400 text-[#1b1b18] py-3 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-amber-300 transition shadow-md shadow-amber-200/50">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Join -->
    <div id="modalJoin" class="fixed inset-0 z-[150] modal-hidden">
        <div class="fixed inset-0 bg-[#1b1b18]/60 backdrop-blur-sm modal-overlay" onclick="closeModal('modalJoin')"></div>
        <div class="relative bg-white border border-gray-100 rounded-3xl w-full max-w-md p-10 shadow-2xl mx-auto mt-20">
            <form method="post" action="{{ route('colocations.join') }}">
                @csrf
                <h2 class="text-sm font-bold text-[#1b1b18] uppercase tracking-[0.3em] mb-8 border-b border-gray-100 pb-4">
                    Join a Colocation
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Invitation Code</label>
                        <input type="text" name="invitation_code" required
                               class="w-full bg-white border border-gray-200 text-[#1b1b18] text-sm
                                      focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                      transition px-4 py-3 rounded-xl uppercase font-mono outline-none shadow-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="button" onclick="closeModal('modalJoin')"
                                class="flex-1 bg-gray-100 text-gray-500 py-3 text-xs font-bold uppercase rounded-xl hover:bg-gray-200 transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-[2] bg-[#1b1b18] text-white py-3 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-gray-800 transition">
                            Join
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('modal-hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('modal-hidden');
        }
    </script>
</x-app-layout>