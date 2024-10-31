<?php

namespace App\Services;

use App\Models\TicketLog;

class TicketLogService
{
    public static function getTicketLog($unique_code)
    {
        $ticketLog = TicketLog::where('unique_code', $unique_code)->first();
        if (is_null($ticketLog)) {
            abort(404);
        }
        return $ticketLog;
    }
}
