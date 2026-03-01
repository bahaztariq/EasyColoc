<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/banned', function () {
    return view('banned');
})->middleware(['auth', 'check.banned'])->name('banned');

Route::get('/colocation', [ColocationController::class, 'index'])->middleware(['auth', 'verified', 'check.banned'])->name('colocation.index');

Route::middleware(['auth', 'check.banned'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::delete('/colocations/leave', [ColocationController::class, 'leave'])->name('colocation.leave');
    Route::delete('/colocations/kick/{user}', [ColocationController::class, 'kick'])->name('colocation.kick');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::post('/payments/settle', [PaymentController::class, 'settle'])->name('payments.settle');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::post('/users/{user}/ban', [\App\Http\Controllers\AdminController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [\App\Http\Controllers\AdminController::class, 'unban'])->name('users.unban');
});

require __DIR__.'/auth.php';


Route::post('/colocations/{colocation}/invite', [InvitationController::class, 'send'])
    ->middleware('auth')
    ->name('invitation.send');


Route::get('/invitation/accept/{token}', [InvitationController::class, 'accept'])
    ->middleware('signed')
    ->name('invitation.accept');