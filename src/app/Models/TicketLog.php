<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TicketLog extends Model
{
    protected $guarded = [
        'id',
    ];
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($ticketlog) {
            do {
                $unique_code = (string) Str::uuid();
            } while (self::where('unique_code', $unique_code)->exists());

            $ticketlog->unique_code = $unique_code;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
