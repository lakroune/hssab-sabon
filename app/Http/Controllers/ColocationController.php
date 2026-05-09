<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColocationController extends Controller
{
  public function index()
{
    $user = auth()->user();

    $colocations = $user->colocations;

    $totalCredits = \App\Models\Debt::where('creditor_id', $user->id)->sum('amount');

    $totalDebts = \App\Models\Debt::where('debtor_id', $user->id)->sum('amount');

    return view('dashboard', compact('colocations', 'totalCredits', 'totalDebts'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'invitation_code' => strtoupper(Str::random(8)),
            'owner_id' => auth()->id(),
        ]);

        $colocation->members()->attach(auth()->id(), ['role' => 'admin']);

        return redirect()->route('colocations.show', $colocation);
    }

    public function join(Request $request)
    {
        $request->validate([
            'invitation_code' => 'required|string|exists:colocations,invitation_code',
        ]);

        $colocation = Colocation::where('invitation_code', $request->invitation_code)->first();

        if ($colocation->members()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You are already a member of this colocation.');
        }

        $colocation->members()->attach(auth()->id(), ['role' => 'member']);

        return redirect()->route('colocations.show', $colocation);
    }

    public function show(Colocation $colocation)
    {
        if (!$colocation->members->contains(auth()->id())) {
            abort(403);
        }
        $colocation->load(['members', 'transactions.payer', 'debts.debtor', 'debts.creditor']);

        $myDebts = $colocation->debts()->where('debtor_id', auth()->id())->sum('amount');
        $myCredits = $colocation->debts()->where('creditor_id', auth()->id())->sum('amount');

        return view('colocations.show', compact('colocation', 'myDebts', 'myCredits'));
    }

    public function stats(Colocation $colocation)
    {
        $stats = $colocation->transactions()
            ->selectRaw('category, sum(amount) as total')
            ->groupBy('category')
            ->get();

        return view('colocations.stats', compact('colocation', 'stats'));
    }

    public function regenerateCode(Colocation $colocation)
    {
        if ($colocation->owner_id !== auth()->id()) {
            abort(403);
        }

        $colocation->update([
            'invitation_code' => strtoupper(Str::random(8))
        ]);

        return back()->with('success', 'New invitation code generated.');
    }
}
