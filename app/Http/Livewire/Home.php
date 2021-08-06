<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $company_id=2;
    
    public function render()
    {
        return view('livewire.home');
    }
    
    public function mount()
    {
        \LogActivity::add('Home');
    }
}
