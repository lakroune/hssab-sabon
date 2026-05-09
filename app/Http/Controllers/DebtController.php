<?php
namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Colocation;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function settle(Request $request, Colocation $colocation)
    {
        $request->validate([
            'debt_id' => 'required|exists:debts,id',
        ]);

        $debt = Debt::findOrFail($request->debt_id);

        // Logic: Only Coloc Admin or the Creditor can settle the debt
        $is_admin = $colocation->members()->where('user_id', auth()->id())->where('role', 'admin')->exists();
        $is_creditor = $debt->creditor_id === auth()->id();

        if (!$is_admin && !$is_creditor) {
            return back()->with('error', 'You do not have permission to settle this debt.');
        }

        // We don't delete the debt if it's partially paid (optional logic)
        // For now, we settle the whole amount as requested in your scenario
        $debt->delete();

        return back()->with('success', 'Debt settled successfully.');
    }

    public function userSummary(Colocation $colocation)
    {
        // Get all people I owe money to
        $iOwe = $colocation->debts()
            ->where('debtor_id', auth()->id())
            ->with('creditor')
            ->get();

        // Get all people who owe me money
        $oweMe = $colocation->debts()
            ->where('creditor_id', auth()->id())
            ->with('debtor')
            ->get();

        return view('colocations.debts', compact('colocation', 'iOwe', 'oweMe'));
    }
}