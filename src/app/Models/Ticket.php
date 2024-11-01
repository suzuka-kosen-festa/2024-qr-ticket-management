<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $guarded = [
        'id',
    ];

    public function ticketLog()
    {
        return $this->hasMany(TicketLog::class, 'ticket_id', 'id');
    }
}
