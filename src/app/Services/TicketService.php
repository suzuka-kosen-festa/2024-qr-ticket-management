<?php

namespace App\Services;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public static function getBalancedTicketList()
    {
        // $now = Carbon::now();
        $now = Carbon::parse('2024-11-01 21:00:00');

        $tickets = Ticket::where('balance', '>', 0)
            ->where('sale_start_time', '<=', $now)
            ->where('end_time', '>', $now)
            ->orderBy('event_date')
            ->orderBy('end_time')
            ->select('id', 'event_date', 'title', 'balance')
            ->get();

        $groupedTickets = $tickets->groupBy('event_date')->map(function ($tickets) {
            return $tickets->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'event_date' => $ticket->event_date,
                    'title' => $ticket->title,
                    'balance' => $ticket->balance,
                ];
            });
        });

        return $groupedTickets;
    }

    public static function getAllTciketList()
    {
        $tickets = Ticket::orderBy('event_date')
            ->orderBy('end_time')
            ->select('id', 'event_date', 'title', 'balance', 'sale_start_time', 'end_time')
            ->get();

        $groupedTickets = $tickets->groupBy('event_date')->map(function ($tickets) {
            return $tickets->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'event_date' => $ticket->event_date,
                    'title' => $ticket->title,
                    'balance' => $ticket->balance,
                    'sale_start_time' => $ticket->sale_start_time,
                    'end_time' => $ticket->end_time,
                ];
            });
        });

        return $groupedTickets;
    }

    public static function TryBuyTicket($user, $ticket_id)
    {
        DB::beginTransaction();

        try{
            $ticket = Ticket::findOrFail($ticket_id);

            if ($ticket->balance <= 0) {
                DB::rollBack();
                return [
                    'status' => 'error',
                    'message' => 'This ticket is sold out.'
                ];
            }

            $ticket_log = $user->ticketLog()->create([
                'ticket_id' => $ticket_id,
            ]);

            $ticket->decrement('balance');

            DB::commit();

            return [
                'status' => 'success',
                'ticket_log' => $ticket_log
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            dd($e);

            return [
                'status' => 'error',
                'message' => 'Failed to submit ticket',
                'exception' => $e->getMessage()
            ];

        }
    }
}
