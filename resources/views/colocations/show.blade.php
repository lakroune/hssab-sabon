<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-[#1b1b18] uppercase tracking-widest">
                    {{ $colocation->name }}
                </h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-gray-400 text-xs font-mono">CODE:</span>
                    <span id="invitationCode"
                          class="bg-amber-50 text-amber-700 border border-amber-200 px-2 py-0.5 rounded-lg text-xs font-mono font-bold tracking-wider">
                        {{ $colocation->invitation_code }}
                    </span>
                    <button onclick="copyCode()" class="text-gray-400 hover:text-amber-600 transition" title="Copy code">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex gap-2">
                {{-- Reset Code: owner only --}}
                @if ($colocation->owner_id === auth()->id())
                    <form action="{{ route('colocations.regenerate', $colocation) }}" method="POST"
                          onsubmit="return confirm('Generate new code? Old code will stop working.')">
                        @csrf
                        <button type="submit"
                                class="bg-white hover:bg-gray-50 text-[#1b1b18] px-4 py-2 text-xs font-bold transition border border-gray-200 uppercase rounded-lg shadow-sm">
                            Reset Code
                        </button>
                    </form>
                @endif

                <button onclick="openModal('addTransactionModal')"
                        class="bg-amber-400 hover:bg-amber-300 text-[#1b1b18] px-6 py-2 text-xs font-bold transition uppercase tracking-widest rounded-lg shadow-md shadow-amber-200/50">
                    New Transaction
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">

                <!-- Left Sidebar -->
                <div class="col-span-12 lg:col-span-4 space-y-4">

                    <div class="bg-white border border-gray-100 rounded-2xl border-l-4 border-l-emerald-400 p-6 shadow-sm">
                        <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Total Credit</p>
                        <p class="text-3xl font-light text-emerald-500 mt-2">{{ number_format($myCredits, 2) }} MAD</p>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-2xl border-l-4 border-l-rose-400 p-6 shadow-sm">
                        <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Total Debt</p>
                        <p class="text-3xl font-light text-rose-500 mt-2">{{ number_format($myDebts, 2) }} MAD</p>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-[#1b1b18] text-sm font-bold tracking-widest mb-4 uppercase">Members</h3>
                        <div class="space-y-3">
                            @foreach ($colocation->members as $member)
                                <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center text-amber-700 text-xs font-bold">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                        <span class="text-[#1b1b18] text-sm font-medium">{{ $member->name }}</span>
                                    </div>
                                    <span class="text-[10px] font-bold px-2 py-1 bg-amber-50 text-amber-700 rounded-full uppercase tracking-wide">
                                        {{ $member->pivot->role }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Transactions Table -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-[#1b1b18] text-sm font-bold tracking-widest uppercase">Recent History</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Payer</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($colocation->transactions as $transaction)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="px-6 py-4 text-sm text-[#1b1b18]">{{ $transaction->description }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $transaction->payer->name }}</td>
                                            <td class="px-6 py-4">
                                                <span class="text-[10px] font-bold px-2 py-1 rounded-full uppercase
                                                    {{ $transaction->type == 'shared' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-500' }}">
                                                    {{ $transaction->type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-mono font-bold
                                                {{ $transaction->payer_id == auth()->id() ? 'text-emerald-500' : 'text-gray-400' }}">
                                                {{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                {{-- Delete: mol transaction (payer) only --}}
                                                @if ($transaction->payer_id === auth()->id())
                                                    <form action="{{ route('transactions.destroy', [$colocation, $transaction]) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Confirm Deletion?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="text-rose-400 hover:text-rose-600 text-xs font-bold uppercase tracking-tighter transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-200 text-xs select-none">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal: Add Transaction -->
    <div id="addTransactionModal" class="fixed inset-0 z-[150] modal-hidden">
        <div class="fixed inset-0 bg-[#1b1b18]/60 backdrop-blur-sm modal-overlay" onclick="closeModal('addTransactionModal')"></div>
        <div class="relative bg-white border border-gray-100 rounded-3xl w-full max-w-lg p-10 shadow-2xl mx-auto mt-20">
            <form method="POST" action="{{ route('transactions.store', $colocation) }}">
                @csrf
                <h2 class="text-sm font-bold text-[#1b1b18] mb-8 uppercase tracking-widest border-b border-gray-100 pb-4">
                    New Transaction
                </h2>
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Description</label>
                        <input type="text" name="description" required placeholder="e.g. Electricity Bill"
                               class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                      focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Amount (MAD)</label>
                            <input type="number" step="0.01" name="amount" required
                                   class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                          focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Type</label>
                            <select name="type" id="typeSelect" onchange="toggleReceiver(this.value)"
                                    class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                           focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                                <option value="shared">Shared (Group)</option>
                                <option value="p2p">Private Loan (P2P)</option>
                            </select>
                        </div>
                    </div>
                    <div id="receiverContainer" class="hidden">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Select Receiver</label>
                        <select name="receiver_id"
                                class="w-full bg-white border border-gray-200 text-[#1b1b18] px-4 py-3 rounded-xl outline-none
                                       focus:ring-2 focus:ring-amber-400 focus:border-transparent transition shadow-sm text-sm">
                            @foreach ($colocation->members as $member)
                                @if ($member->id !== auth()->id())
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-8 flex gap-2">
                    <button type="button" onclick="closeModal('addTransactionModal')"
                            class="flex-1 bg-gray-100 text-gray-500 py-3 text-xs font-bold uppercase rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-[2] bg-amber-400 text-[#1b1b18] py-3 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-amber-300 transition shadow-md shadow-amber-200/50">
                        Post Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleReceiver(val) {
            document.getElementById('receiverContainer').classList.toggle('hidden', val !== 'p2p');
        }
        function copyCode() {
            const code = document.getElementById('invitationCode').innerText;
            navigator.clipboard.writeText(code).then(() => {
                showToast('Code copied: ' + code, 'success');
            });
        }
        function openModal(id) {
            document.getElementById(id).classList.remove('modal-hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('modal-hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-app-layout>