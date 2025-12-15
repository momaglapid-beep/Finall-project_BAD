<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LendingController; // <--- This was likely missing!
use App\Http\Controllers\ApprovalController; 

// --- Public Routes ---
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Routes (Must be Logged In) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Borrowing
    Route::get('/borrow/{id}', [LendingController::class, 'showBorrowForm'])->name('borrow.form');
    Route::post('/borrow/{id}', [LendingController::class, 'submitRequest'])->name('borrow.submit');

    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals');
Route::post('/approve/{id}', [ApprovalController::class, 'approve'])->name('approve');
Route::post('/decline/{id}', [ApprovalController::class, 'decline'])->name('decline');

// Active Loans & Returns
Route::get('/active-loans', [ApprovalController::class, 'showActiveLoans'])->name('active.loans');
Route::post('/return/{id}', [ApprovalController::class, 'processReturn'])->name('process.return');

Route::get('/history', [ApprovalController::class, 'showHistory'])->name('history');    
});