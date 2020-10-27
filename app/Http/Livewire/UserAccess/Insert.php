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

        UserAccess::insert(['name'=>$this->name,'description'=>$this->description]);

        return redirect()->to('user-access');
    }
    
    public function render()
    {
        return view('livewire.user-access.insert');
    }
}
