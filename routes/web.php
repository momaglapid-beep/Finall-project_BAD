<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EquipmentController; 

// --- Public Routes ---
Route::get('/', function () { return redirect('/login'); });

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Routes (Must be Logged In) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Borrowing
    Route::get('/borrow/{id}', [LendingController::class, 'showBorrowForm'])->name('borrow.form');
    Route::post('/borrow/{id}', [LendingController::class, 'submitRequest'])->name('borrow.submit');

    // Admin: Approvals & Returns
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals');
    Route::post('/approve/{id}', [ApprovalController::class, 'approve'])->name('approve');
    Route::post('/decline/{id}', [ApprovalController::class, 'decline'])->name('decline');
    Route::get('/active-loans', [ApprovalController::class, 'showActiveLoans'])->name('active.loans');
    Route::post('/return/{id}', [ApprovalController::class, 'processReturn'])->name('process.return');
    Route::get('/history', [ApprovalController::class, 'showHistory'])->name('history');

    // Admin: Equipment Management (CRUD)
    Route::get('/equipment/add', [EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/equipment/add', [EquipmentController::class, 'store'])->name('equipment.store');
    
    Route::get('/equipment/edit/{id}', [EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::post('/equipment/update/{id}', [EquipmentController::class, 'update'])->name('equipment.update');
    
    Route::post('/equipment/delete/{id}', [EquipmentController::class, 'destroy'])->name('equipment.delete');

});