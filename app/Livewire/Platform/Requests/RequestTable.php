<?php

namespace App\Livewire\Platform\Requests;

use App\Models\TeamRequest;
use Livewire\Component;

class RequestTable extends Component
{
    public function accept($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->accept();
    }

    public function decline($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->decline();
    }

    public function remove($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->remove();
    }

    public function render()
    {
        return view('platform::livewire.requests.request-table');
    }
}
