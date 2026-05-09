<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white uppercase tracking-widest">
                    {{ $colocation->name }}
                </h2>
                <p class="text-slate-500 text-xs font-mono mt-1">REF: {{ $colocation->invitation_code }}</p>
            </div>
            <div class="flex gap-4">
                <button @click="$dispatch('open-modal', 'add-transaction')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 text-sm font-bold transition">
                    NEW TRANSACTION
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
                            @foreach($colocation->members as $member)
                                <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                    <span class="text-slate-300 text-sm">{{ $member->name }}</span>
                                    <span class="text-[10px] font-bold px-2 py-1 bg-slate-800 text-slate-500 uppercase">{{ $member->pivot->role }}</span>
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
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Payer</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800">
                                    @foreach($colocation->transactions as $transaction)
                                        <tr class="hover:bg-slate-800/30 transition">
                                            <td class="px-6 py-4 text-sm text-slate-300">{{ $transaction->description }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-300">{{ $transaction->payer->name }}</td>
                                            <td class="px-6 py-4">
                                                <span class="text-[10px] font-bold px-2 py-1 {{ $transaction->type == 'shared' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }} uppercase">
                                                    {{ $transaction->type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-mono {{ $transaction->payer_id == auth()->id() ? 'text-emerald-400' : 'text-slate-400' }}">
                                                {{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form action="{{ route('transactions.destroy', [$colocation, $transaction]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-500 hover:text-rose-400 text-xs font-bold uppercase">Delete</button>
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

    <x-modal name="add-transaction" focusable>
        <form method="POST" action="{{ route('transactions.store', $colocation) }}" class="p-8 bg-slate-900">
            @csrf
            <h2 class="text-lg font-bold text-white mb-6 uppercase tracking-widest">New Transaction</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Description</label>
                    <input type="text" name="description" class="w-full bg-slate-800 border-slate-700 text-white focus:ring-blue-600 focus:border-blue-600" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Amount (MAD)</label>
                        <input type="number" step="0.01" name="amount" class="w-full bg-slate-800 border-slate-700 text-white focus:ring-blue-600 focus:border-blue-600" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Type</label>
                        <select name="type" x-model="type" class="w-full bg-slate-800 border-slate-700 text-white focus:ring-blue-600 focus:border-blue-600">
                            <option value="shared">Shared</option>
                            <option value="p2p">Private Loan</option>
                        </select>
                    </div>
                </div>

                <div x-show="type === 'p2p'" class="mt-4">
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Receiver</label>
                    <select name="receiver_id" class="w-full bg-slate-800 border-slate-700 text-white focus:ring-blue-600 focus:border-blue-600">
                        @foreach($colocation->members as $member)
                            @if($member->id !== auth()->id())
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <button type="button" @click="$dispatch('close')" class="px-6 py-2 text-xs font-bold text-slate-400 uppercase hover:text-white transition">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-8 py-2 text-xs font-bold uppercase hover:bg-blue-700 transition">Confirm</button>
            </div>
        </form>
    </x-modal>
</x-app-layout>