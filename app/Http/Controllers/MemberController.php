<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\User;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function kick(Colocation $colocation, User $user)
    {
        $currentUserId = auth()->id();

        $isAdmin = $colocation->members()
            ->where('user_id', $currentUserId)
            ->where('role', 'admin')
            ->exists();

        if (!$isAdmin) {
            return back()->with('error', 'Only admins can kick members');
        }

        if ($user->id === $currentUserId) {
            return back()->with('error', 'You cannot kick yourself. Use the leave option instead');
        }

        if ($this->hasActiveDebts($user->id, $colocation->id)) {
            return back()->with('error', 'Cannot kick member. Their balance must be 0 DH first');
        }

        $colocation->members()->detach($user->id);

        return back()->with('success', 'Member has been removed from the colocation');
    }

    public function leave(Colocation $colocation)
    {
        $userId = auth()->id();

        $pivot = $colocation->members()->where('user_id', $userId)->first()->pivot;

        if ($pivot->role === 'admin') {
            $adminCount = $colocation->members()->where('role', 'admin')->count();
            if ($adminCount === 1 && $colocation->members()->count() > 1) {
                return back()->with('error', 'Please appoint another admin before leaving');
            }
        }

        if ($this->hasActiveDebts($userId, $colocation->id)) {
            return back()->with('error', 'You cannot leave with active debts or pending settlements');
        }

        DB::transaction(function () use ($colocation, $userId, $pivot) {
            $colocation->members()->detach($userId);

            if ($colocation->members()->count() === 0) {
                $colocation->delete();
            } elseif ($pivot->role === 'admin') {
                $nextMember = $colocation->members()->first();
                if ($nextMember) {
                    $colocation->members()->updateExistingPivot($nextMember->id, ['role' => 'admin']);
                }
            }
        });

        return redirect()->route('dashboard')->with('success', 'You have left the colocation');
    }

    private function hasActiveDebts($userId, $colocationId)
    {
        return Debt::where('colocation_id', $colocationId)
            ->where(function ($query) use ($userId) {
                $query->where('debtor_id', $userId)
                      ->orWhere('creditor_id', $userId);
            })
            ->where('amount', '>', 0)
            ->exists();
    }
}