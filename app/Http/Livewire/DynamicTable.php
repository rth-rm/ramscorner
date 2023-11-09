<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\StatusHistory;
use App\Models\Reporter;
use App\Models\Ticket;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View\share;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\TicketMessages;

class DynamicTable extends Component
{
    public $selectedOption = '';
    public $data = [];

    public function render()
    {
        // Based on the selected option, call the appropriate method to fetch the data
        if ($this->selectedOption === 'Sent Ticket') {
            $this->getSentTicketsData();
        } elseif ($this->selectedOption === 'Received Ticket') {
            $this->getReceivedTicketsData();
        } elseif ($this->selectedOption === 'Tagged Tickets') {
            $this->getTaggedTicketsData();
        }

        return view('livewire.dynamic-table', ['data' => $this->data]);
    }

    public function getSentTicketsData()
    {
        // Logic to fetch Sent Ticket data
        // Example: Dummy data for demonstration
        $this->data = [
            ['column1' => 'Sent Ticket 1', 'column2' => 'Value1'],
            ['column1' => 'Sent Ticket 2', 'column2' => 'Value2'],
            // Add more data as needed
        ];
    }

    public function getReceivedTicketsData()
    {
        // Logic to fetch Received Ticket data
        // Example: Dummy data for demonstration
        $this->data = [
            ['column1' => 'Received Ticket 1', 'column2' => 'Value1'],
            ['column1' => 'Received Ticket 2', 'column2' => 'Value2'],
            // Add more data as needed
        ];
    }

    public function getTaggedTicketsData()
    {
        // Logic to fetch Tagged Ticket data
        // Example: Dummy data for demonstration
        $this->data = [
            ['column1' => 'Tagged Ticket 1', 'column2' => 'Value1'],
            ['column1' => 'Tagged Ticket 2', 'column2' => 'Value2'],
            // Add more data as needed
        ];
    }
}
