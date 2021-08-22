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

    public function updated($propertyName)
    {
        session()->put('company_id',$this->$propertyName);
    }
    
    public function mount()
    {
        \LogActivity::add('Home');

        if(session()->get('company_id')) $this->company_id = session()->get('company_id');
    }
}