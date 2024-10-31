<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TokenService;
use App\Services\TicketLogService;

class UserTicketController extends Controller
{
    public function index(Request $request)
    {
        $user = TokenService::getTokenUser($request);

        $ticketLog = $user->ticketLog()->first();

        if (!is_null($ticketLog)) {
            return redirect()->route('ticket.qrShow', $ticketLog->unique_code);
        }

        return view('ticket.form' , [
            'user' => $user,
        ]);
    }

    public function qrShow($unique_code)
    {
        $ticketLog = TicketLogService::getTicketLog($unique_code);

        return view('ticket.qr', [
            'ticket_log' => $ticketLog,
            'ticket' => $ticketLog->ticket,
            'user' => $ticketLog->user,
        ]);
    }
}
