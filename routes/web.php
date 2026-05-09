<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [ColocationController::class, 'index'])->name('dashboard');

    Route::prefix('colocations')->group(function () {
        Route::post('/create', [ColocationController::class, 'store'])->name('colocations.store');
        Route::post('/join', [ColocationController::class, 'join'])->name('colocations.join');
        
        Route::middleware('can:view,colocation')->group(function () {
            Route::get('/{colocation}', [ColocationController::class, 'show'])->name('colocations.show');
            Route::get('/{colocation}/statistics', [ColocationController::class, 'stats'])->name('colocations.stats');
            
            Route::post('/{colocation}/transactions', [TransactionController::class, 'store'])->name('transactions.store');
            Route::delete('/{colocation}/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
            
            Route::post('/{colocation}/settle', [DebtController::class, 'settle'])->name('debts.settle');
            
            Route::post('/{colocation}/shopping', [ShoppingListController::class, 'store'])->name('shopping.store');
            Route::patch('/{colocation}/shopping/{item}', [ShoppingListController::class, 'update'])->name('shopping.update');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';