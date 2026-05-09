<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white uppercase tracking-widest">
                    {{ $colocation->name }}
                </h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-slate-500 text-xs font-mono">REF:</span>
                    <span
                        class="bg-slate-800 text-blue-400 px-2 py-0.5 rounded text-xs font-mono font-bold tracking-wider"
                        id="invitationCode">
                        {{ $colocation->invitation_code }}
                    </span>
                    <button onclick="copyCode()" class="text-slate-500 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex gap-2">
                @if ($colocation->owner_id === auth()->id())
                    <form action="{{ route('colocations.regenerate', $colocation) }}" method="POST"
                        onsubmit="return confirm('Generate new code? Old code will stop working.')">
                        @csrf
                        <button type="submit"
                            class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 text-xs font-bold transition border border-slate-700 uppercase">
                            Reset Code
                        </button>
                    </form>
                @endif
                <button onclick="openModal('addTransactionModal')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 text-xs font-bold transition uppercase tracking-widest">
                    New Transaction
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-slate-900 border-l-4 border-emerald-500 p-6 shadow-xl">
                        <p class="text-slate-500 text-xs font-bold tracking-wider">TOTAL CREDIT</p>
                        <p class="text-3xl font-light text-emerald-400 mt-2">{{ number_format($myCredits, 2) }} MAD</p>
                    </div>

                    <div class="bg-slate-900 border-l-4 border-rose-500 p-6 shadow-xl">
                        <p class="text-slate-500 text-xs font-bold tracking-wider">TOTAL DEBT</p>
                        <p class="text-3xl font-light text-rose-500 mt-2">{{ number_format($myDebts, 2) }} MAD</p>
                    </div>

                    <div class="bg-slate-900 p-6 border border-slate-800">
                        <h3 class="text-white text-sm font-bold tracking-widest mb-4 uppercase">Members</h3>
                        <div class="space-y-4">
                            @foreach ($colocation->members as $member)
                                <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                    <span class="text-slate-300 text-sm">{{ $member->name }}</span>
                                    <span
                                        class="text-[10px] font-bold px-2 py-1 bg-slate-800 text-slate-500 uppercase">{{ $member->pivot->role }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-slate-900 border border-slate-800">
                        <div class="px-6 py-4 border-b border-slate-800 flex justify-between items-center">
                            <h3 class="text-white text-sm font-bold tracking-widest uppercase">Recent History</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-800/50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                            Description</th>
                                        <th
                                            class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                            Payer</th>
                                        <th
                                            class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                            Type</th>
                                        <th
                                            class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800">
                                    @foreach ($colocation->transactions as $transaction)
                                        <tr class="hover:bg-slate-800/30 transition">
                                            <td class="px-6 py-4 text-sm text-slate-300">{{ $transaction->description }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-300">{{ $transaction->payer->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="text-[10px] font-bold px-2 py-1 {{ $transaction->type == 'shared' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }} uppercase">
                                                    {{ $transaction->type }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-mono {{ $transaction->payer_id == auth()->id() ? 'text-emerald-400' : 'text-slate-400' }}">
                                                {{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form
                                                    action="{{ route('transactions.destroy', [$colocation, $transaction]) }}"
                                                    method="POST" onsubmit="return confirm('Confirm Deletion?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-rose-500 hover:text-rose-400 text-xs font-bold uppercase tracking-tighter">Delete</button>
                                                </form>
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

    <!-- Modal Layout Vanilla JS -->
    <div id="addTransactionModal" class="fixed inset-0 z-[150] modal-hidden">
        <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-sm modal-overlay"></div>
        <div class="relative bg-slate-900 border border-slate-700 w-full max-w-lg p-10 shadow-2xl mx-auto mt-20">
            <form method="POST" action="{{ route('transactions.store', $colocation) }}">
                @csrf
                <h2 class="text-lg font-bold text-white mb-8 uppercase tracking-widest border-b border-slate-800 pb-4">
                    New Transaction</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Description</label>
                        <input type="text" name="description"
                            class="w-full bg-slate-950 border-slate-800 text-white px-4 py-3 border outline-none focus:border-blue-600"
                            required placeholder="e.g. Electricity Bill">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Amount
                                (MAD)</label>
                            <input type="number" step="0.01" name="amount"
                                class="w-full bg-slate-950 border-slate-800 text-white px-4 py-3 border outline-none focus:border-blue-600"
                                required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Type</label>
                            <select name="type" id="typeSelect" onchange="toggleReceiver(this.value)"
                                class="w-full bg-slate-950 border-slate-800 text-white px-4 py-3 border outline-none focus:border-blue-600">
                                <option value="shared">Shared (Group)</option>
                                <option value="p2p">Private Loan (P2P)</option>
                            </select>
                        </div>
                    </div>

                    <!-- P2P Receiver Selection -->
                    <div id="receiverContainer" class="hidden">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-2">Select Receiver</label>
                        <select name="receiver_id"
                            class="w-full bg-slate-950 border-slate-800 text-white px-4 py-3 border outline-none focus:border-blue-600">
                            @foreach ($colocation->members as $member)
                                @if ($member->id !== auth()->id())
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addTransactionModal')"
                        class="flex-1 bg-slate-800 text-slate-400 py-4 text-xs font-bold uppercase hover:bg-slate-700 transition">Cancel</button>
                    <button type="submit"
                        class="flex-[2] bg-blue-600 text-white py-4 text-xs font-bold uppercase hover:bg-blue-700 transition tracking-widest">Post
                        Transaction</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleReceiver(val) {
            const container = document.getElementById('receiverContainer');
            if (val === 'p2p') {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }

        function copyCode() {
            const code = document.getElementById('invitationCode').innerText;
            navigator.clipboard.writeText(code).then(() => {
                alert('Code copied to clipboard: ' + code);
            });
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('modal-hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('modal-hidden');
        }
    </script>
</x-app-layout>
