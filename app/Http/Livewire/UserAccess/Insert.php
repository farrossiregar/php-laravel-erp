<?php

namespace App\Http\Livewire\UserAccess;

use Livewire\Component;
use App\Models\UserAccess;

class Insert extends Component
{
    public $name;
    public $description;
    public $message;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
    ];

    public function save(){
        $this->validate();

        $access = new UserAccess();
        $access->name = $this->name;
        $access->description = $this->description;
        $access->save();
        $this->reset('name','description');
        $this->emit('message-success',__('Data saved successfully'));
        $this->emit('refresh-page');
    }
    
    public function render()
    {
        return view('livewire.user-access.insert');
    }
}
