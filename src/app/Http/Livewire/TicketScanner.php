<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TicketLog;
use Carbon\Carbon;

class TicketScanner extends Component
{
    protected $listeners = ['attend'];

    public function attend($unique_code)
    {
        $ticketLog = TicketLog::where('unique_code', $unique_code)->first();
        if ($ticketLog) {
            if ($ticketLog->status === null) {
                $ticketLog->update(['status' => Carbon::now()]);
                session()->flash('message', 'チケットが認証されました。');
            } else {
                session()->flash('message', 'このチケットは既に使用されています。');
            }
        } else {
            session()->flash('message', '無効なチケットです。');
        }
    }

    public function render()
    {
        return view('livewire.ticket-scanner');
    }
}
