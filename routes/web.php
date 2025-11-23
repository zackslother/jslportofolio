<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/projects/about', [ProjectsController::class, 'about'])->name('projects.about');
Route::get('/projects/projects', [ProjectsController::class, 'projects'])->name('projects/projects');

// PROJECTS resource
Route::resource('projects', ProjectsController::class);

/**
 * PAYMENTS routes
 */
Route::resource('payments', PaymentsController::class)->except(['show']);
// Checkout page (GET)
Route::get('/payments/checkout/{project}', [PaymentsController::class, 'showByProject'])->name('payments.showByProject');
// Submit payment (POST)
Route::post('/payments/payment/{project}', [PaymentsController::class, 'paymentByProject'])->name('payments.paymentByProject');
// Success page
Route::get('/payments/success', [PaymentsController::class, 'success'])->name('payments.success');

/**
 * ADMIN routes
 */
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Projects management 
Route::get('admin/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
Route::post('admin/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
Route::get('admin/projects/{project}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
Route::put('admin/projects/{project}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
Route::delete('admin/projects/{project}', [AdminController::class, 'destroyProject'])->name('admin.projects.destroy');

// Payments management 
Route::post('admin/payments/{id}/approve', [AdminController::class, 'approvePayment'])->name('admin.payments.approve');
Route::post('admin/payments/{id}/reject', [AdminController::class, 'rejectPayment'])->name('admin.payments.reject');
Route::delete('admin/payments/{id}', [AdminController::class, 'destroyPayment'])->name('admin.payments.destroy');

/**
 * USERS routes
 */
Route::get('/users/status', [UserController::class, 'status'])->name('users.status');
