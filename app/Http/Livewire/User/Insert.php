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

        User::insert(['name'=>$this->name,'email'=>$this->email,'password'=>Hash::make($this->password),'telepon'=>$this->telepon,'address'=>$this->address]);

        return redirect()->to('users');
    }
}
