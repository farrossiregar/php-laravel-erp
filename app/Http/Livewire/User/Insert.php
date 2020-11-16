<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Hash;

class Insert extends Component
{
    public $name;
    public $email;
    public $password;
    public $telepon;
    public $address;
    public $user_access_id;
    public $message;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string',
        'telepon' => 'required'
    ];

    public function render()
    {
        $params['access'] = UserAccess::all();

        return view('livewire.user.insert')->with($params);
    }

    public function save(){
        $this->validate();
        
        $data = new User();
        $data->name = $this->name;
        $data->email = $this->email;
        $data->password = Hash::make($this->password);
        $data->telepon = $this->telepon;
        $data->address = $this->address;
        $data->user_access_id = $this->user_access_id;
        $data->save();

        return redirect()->to('users');
    }
}
