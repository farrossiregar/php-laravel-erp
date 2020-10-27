<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

class Index extends Component
{
    public $keyword;

    public function render()
    {
        $data = User::orderBy('id','desc');

        if($this->keyword) $data = $data->where('name','LIKE', '%'.$this->keyword.'%')
                                        ->orWhere('email','LIKE', '%'.$this->keyword.'%')
                                        ->orWhere('telepon','LIKE', '%'.$this->keyword.'%');

        return view('livewire.user.index')
                ->layout('layouts.app')
                ->with(['data'=>$data->get()]);
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
}
