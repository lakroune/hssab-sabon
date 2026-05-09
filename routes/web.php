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

        Route::group(['prefix' => '{colocation}'], function () {
            Route::get('/', [ColocationController::class, 'show'])->name('colocations.show');
            Route::get('/statistics', [ColocationController::class, 'stats'])->name('colocations.stats');

            Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
            Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

            Route::post('/regenerate-code', [ColocationController::class, 'regenerateCode'])->name('colocations.regenerate');

            Route::post('/settle', [DebtController::class, 'settle'])->name('debts.settle');

            Route::post('/shopping', [ShoppingListController::class, 'store'])->name('shopping.store');
            Route::patch('/shopping/{item}', [ShoppingListController::class, 'update'])->name('shopping.update');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
