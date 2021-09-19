<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class Home extends Component
{
    public $company_id,$department,$update_menu_=false;
    
    public function render()
    {
        return view('livewire.home');
    }

    public function updated($propertyName)
    {
        session()->put('company_id',$this->$propertyName);
    }
    
    public function set_department(Department $data)
    {
        $this->department = $data;
        if($this->update_menu_==false){
            $this->emit('update-menu');
            $this->update_menu_=true;
        }
    }

    public function mount()
    {
        \LogActivity::add('Home');

        if(isset($_GET['company_id'])) $this->company_id = $_GET['company_id'];
        if(session()->get('company_id')) $this->company_id = session()->get('company_id');
    }
}