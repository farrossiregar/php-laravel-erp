<?php

namespace App\Http\Livewire\UserAccess;

use Livewire\Component;
use App\Models\UserAccess;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user-access.index')->with(['data'=>UserAccess::all()]);
    }

    public function delete($id){
        UserAccess::find($id)->delete();
    }

    public function autologin()
    {
        
    }
}
