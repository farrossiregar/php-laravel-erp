<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;
class Index extends Component
{    
    public function render()
    {
        // if(!check_access('business-opportunities.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        return view('livewire.vendor-management.index');        
    }
}