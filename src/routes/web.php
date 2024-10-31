<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ticket', [UserTicketController::class, 'index'])->name('ticket');
Route::get('/ticket/{unique_code}', [UserTicketController::class, 'qrShow'])->name('ticket.qrShow');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
