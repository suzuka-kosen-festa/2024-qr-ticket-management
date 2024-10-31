<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\TicketService;
use App\Models\User;

class TicketForm extends Component
{
    public $ticketList;
    public $ticket_id;
    public $user;

    protected $rules = [
        'ticket_id' => 'filled|exists:tickets,id',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->getTicketList();
    }

    protected function getTicketList()
    {
        $this->ticketList = TicketService::getBalancedTicketList();
    }

    public function submitTicket()
    {
        $this->validate();

        $result = TicketService::getTicket($this->user, $this->ticket_id);

        if ($result['status'] === 'error') {
            session()->flash('error', $result['message']);
            return redirect()->back();
        }

        return redirect()->route('ticket.qrShow', ['unique_code' => $result['ticket_log']->unique_code]);
    }

    public function render()
    {
        return view('livewire.ticket-form');
    }
}
