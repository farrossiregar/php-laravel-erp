<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class Home extends Component
{
    public $company_id=2,$department;
    
    public function render()
    {
        return view('livewire.home');
    }

    public function updated($propertyName)
    {
        session()->put('company_id',$this->$propertyName);
        $this->emit('update-menu');
    }
    
    public function set_department(Department $data)
    {
        $this->department = $data;
        $this->emit('update-menu');
    }

    public function mount()
    {
        \LogActivity::add('Home');

        if(session()->get('company_id')) $this->company_id = session()->get('company_id');
    }
}