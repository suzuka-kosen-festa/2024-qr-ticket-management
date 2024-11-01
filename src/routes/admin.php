<?php

use App\Http\Controllers\TicketManagementController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/ticket/scan', function () {
        return view('admin.scan');
    })->name('ticket.scan');

    Route::get('/admin/ticket/dashboard', [TIcketManagementController::class, 'index'])
        ->name('admin.ticket.dashboard');

    Route::get('admin/ticket/{id}/edit', [TicketManagementController::class, 'edit'])
        ->name('admin.ticket.edit');

    Route::post('admin/ticket/{id}/update', [TicketManagementController::class, 'update'])
        ->name('admin.ticket.update');
});
