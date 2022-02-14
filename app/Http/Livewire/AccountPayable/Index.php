<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if(!check_access('hotel-flight-ticket.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.account-payable.index');
    }
}
