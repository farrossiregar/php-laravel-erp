<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if(!check_access('petty-cash.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.petty-cash.index');
    }
}
