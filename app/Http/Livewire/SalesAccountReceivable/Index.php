<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // if(!check_access('sales-account-receivable.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        return view('livewire.sales-account-receivable.index');
    }
}
