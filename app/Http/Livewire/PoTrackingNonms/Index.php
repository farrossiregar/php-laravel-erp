<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if(!check_access('po-tracking-nonms.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.po-tracking-nonms.index');
    }
}