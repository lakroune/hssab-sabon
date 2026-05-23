<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/confidentialite', fn() => view('legal.confidentialite'))->name('legal.privacy');
Route::get('/cgu', fn() => view('legal.cgu'))->name('legal.cgu');
Route::get('/contact', fn() => view('legal.contact'))->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('/colocations/{colocation}/members/{user}/kick', [MemberController::class, 'kick'])->name('colocations.members.kick')->middleware('coloc.member');
    Route::delete('/colocations/{colocation}/leave', [MemberController::class, 'leave'])->name('colocations.leave')->middleware('coloc.member');

    Route::get('/dashboard', [ColocationController::class, 'index'])->name('dashboard');

    Route::prefix('colocations')->group(function () {
        Route::post('/create', [ColocationController::class, 'store'])->name('colocations.store');
        Route::post('/join', [ColocationController::class, 'join'])->name('colocations.join');

        Route::group(['prefix' => '{colocation}', 'middleware' => 'coloc.member'], function () {
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
