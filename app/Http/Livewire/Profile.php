<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{

    public $name;
    public $last_name;
    public $email;
    public $telepon;

    public function render()
    {
        return view('livewire.profile');
    }

    public function mount()
    {
        $this->name = \Auth::user()->name;
        $this->email = \Auth::user()->email;
        $this->telepon = \Auth::user()->telepon;
    }
}
