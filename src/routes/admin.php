<?php

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/scan', function () {
        return view('admin.scan');
    })->name('ticket.scan');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
