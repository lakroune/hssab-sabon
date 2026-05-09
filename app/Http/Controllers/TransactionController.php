<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Colocation;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:shared,p2p',
            'receiver_id' => 'required_if:type,p2p|exists:users,id',
            'category' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $colocation) {
            $transaction = Transaction::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'type' => $request->type,
                'payer_id' => auth()->id(),
                'receiver_id' => $request->type === 'p2p' ? $request->receiver_id : null,
                'colocation_id' => $colocation->id,
                'category' => $request->category,
            ]);

            $this->processDebt($transaction, $colocation, 'add');
        });

        return back()->with('success', 'Transaction added successfully');
    }

    public function destroy(Colocation $colocation, Transaction $transaction)
    {
        DB::transaction(function () use ($colocation, $transaction) {
            $this->processDebt($transaction, $colocation, 'reverse');
            $transaction->delete();
        });

        return back()->with('success', 'Transaction deleted and balances updated');
    }

    private function processDebt(Transaction $transaction, Colocation $colocation, $mode)
    {
        $amount = $transaction->amount;
        $payerId = $transaction->payer_id;

        if ($transaction->type === 'shared') {
            $members = $colocation->members;
            $share = $amount / $members->count();

            foreach ($members as $member) {
                if ($member->id !== $payerId) {
                    if ($mode === 'add') {
                        $this->updateDebt($member->id, $payerId, $colocation->id, $share);
                    } else {
                        $this->updateDebt($payerId, $member->id, $colocation->id, $share);
                    }
                }
            }
        } else {
            if ($mode === 'add') {
                $this->updateDebt($transaction->receiver_id, $payerId, $colocation->id, $amount);
            } else {
                $this->updateDebt($payerId, $transaction->receiver_id, $colocation->id, $amount);
            }
        }
    }

    private function updateDebt($debtorId, $creditorId, $colocationId, $amount)
    {
        $existingDebt = Debt::where([
            'debtor_id' => $creditorId,
            'creditor_id' => $debtorId,
            'colocation_id' => $colocationId
        ])->first();

        if ($existingDebt) {
            if ($existingDebt->amount > $amount) {
                $existingDebt->decrement('amount', $amount);
            } else {
                $remaining = $amount - $existingDebt->amount;
                $existingDebt->delete();
                if ($remaining > 0) {
                    $this->createNewOrUpdateDebt($debtorId, $creditorId, $colocationId, $remaining);
                }
            }
        } else {
            $this->createNewOrUpdateDebt($debtorId, $creditorId, $colocationId, $amount);
        }
    }

    private function createNewOrUpdateDebt($debtorId, $creditorId, $colocationId, $amount)
    {
        $debt = Debt::firstOrCreate(
            ['debtor_id' => $debtorId, 'creditor_id' => $creditorId, 'colocation_id' => $colocationId],
            ['amount' => 0]
        );
        $debt->increment('amount', $amount);
    }
}
