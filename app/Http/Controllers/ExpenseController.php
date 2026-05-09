<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * عرض لوحة التحكم مع كافة الحسابات
     */
    public function index()
    {
        // 1. جلب المصاريف العالقة فقط (التي لم تُصفى بعد)
        $expenses = Expense::where('status', 'pending')
            ->with('user')
            ->latest()
            ->get();

        // 2. المجموع الكلي للمصاريف العالقة
        $totalAmount = Expense::where('status', 'pending')->sum('amount');

        // 3. عدد المستخدمين (الشركاء في السكن)
        $usersCount = User::count();
        $averageShare = $usersCount > 0 ? $totalAmount / $usersCount : 0;

        // 4. جلب المستخدمين مع مجموع ما صرفه كل واحد (فقط المصاريف العالقة)
        $users = User::withSum(['expenses' => function ($query) {
            $query->where('status', 'pending');
        }], 'amount')->get();

        // 5. منطق "شكون يعطي لشكون" (Debt Minimization)
        $debtors = [];
        $creditors = [];

        foreach ($users as $user) {
            // حساب الفارق: ما صرفه الشخص - ما كان يجب عليه صرفه
            $balance = ($user->expenses_sum_amount ?? 0) - $averageShare;
            
            if ($balance < -0.01) {
                $debtors[$user->name] = abs($balance);
            } elseif ($balance > 0.01) {
                $creditors[$user->name] = $balance;
            }
        }

        $suggestions = [];
        foreach ($debtors as $debtorName => &$debt) {
            foreach ($creditors as $creditorName => &$credit) {
                if ($debt <= 0) break;
                if ($credit <= 0) continue;

                $pay = min($debt, $credit);
                $suggestions[] = [
                    'from' => $debtorName,
                    'to' => $creditorName,
                    'amount' => $pay
                ];

                $debt -= $pay;
                $credit -= $pay;
            }
        }

        return view('dashboard', compact('expenses', 'totalAmount', 'users', 'averageShare', 'suggestions'));
    }

    /**
     * تسجيل مصروف جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // تسجيل المصروف وربطه بالمستخدم الحالي
        // استعملنا only لتجنب خطأ MassAssignment الخاص بـ _token
        auth()->user()->expenses()->create([
            'title' => $request->title,
            'amount' => $request->amount,
            'status' => 'pending', // الحالة الافتراضية
        ]);

        return back()->with('success', 'تم تسجيل المصروف بنجاح!');
    }

    /**
     * تصفية الحسابات (إغلاق السجل الحالي)
     */
    public function settle()
    {
        Expense::where('status', 'pending')->update(['status' => 'settled']);

        return back()->with('success', 'تمت تصفية الحسابات بنجاح، سجل جديد بدأ الآن!');
    }
}