<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;

class Index extends Component
{    
    public function render()
    {
        if(!check_access('po-tracking.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.po-tracking.index');        
    }

    public function mount()
    {
        \LogActivity::add('[web] PO Fuel Reimbursement');
    }
}