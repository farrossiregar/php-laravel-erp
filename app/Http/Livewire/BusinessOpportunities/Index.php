<?php

namespace App\Http\Livewire\BusinessOpportunities;

use Livewire\Component;
use Auth;
class Index extends Component
{    
    public function render()
    {
        
        return view('livewire.business-opportunities.index');        
    }
}