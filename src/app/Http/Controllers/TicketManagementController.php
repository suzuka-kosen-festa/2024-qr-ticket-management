<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TicketService;
use App\Models\Ticket;

class TicketManagementController extends Controller
{
    //
    public function index()
    {
        $ticketList = TicketService::getAllTciketList();

        return view('admin.ticket.dashboard', ['ticketList' => $ticketList]);
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $ticketLogList = $ticket->ticketLog()->get();

        return view('admin.ticket.edit', [
            'ticket' => $ticket,
            'ticketLogList' => $ticketLogList,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'sale_start_time' => 'required',
            'end_time' => 'required|after_or_equal:sale_start_time',
            'balance' => 'required|integer|min:0',
        ]);

        $ticket = Ticket::find($id);
        $ticket->update($validatedData);

        return redirect()->route('admin.ticket.edit', ['id' => $ticket->id])
        ->with('success', '整理券情報が更新されました。');
    }
}
