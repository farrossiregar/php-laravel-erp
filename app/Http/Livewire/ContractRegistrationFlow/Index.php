<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Auth;
class Index extends Component
{    
    public function render()
    {
        // if(!check_access('contract-registration-flow.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        return view('livewire.contract-registration-flow.index');        
    }
}