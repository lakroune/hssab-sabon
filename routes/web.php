<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// جميع المسارات اللي كتحتاج تسجيل الدخول (Login)
Route::middleware('auth')->group(function () {
    
    // لوحة التحكم الأساسية (حساب الصابون)
    Route::get('/dashboard', [ExpenseController::class, 'index'])->name('dashboard');
    
    // إدارة المصاريف
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::post('/expenses/settle', [ExpenseController::class, 'settle'])->name('expenses.settle');

    // إدارة البروفايل
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';