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
                session()->flash('success', '整理券が認証されました。');
            } else {
                session()->flash('error', 'この整理券は既に使用されています。');
            }
        } else {
            session()->flash('error', '無効な整理券です。');
        }
    }

    public function render()
    {
        return view('livewire.ticket-scanner');
    }
}
