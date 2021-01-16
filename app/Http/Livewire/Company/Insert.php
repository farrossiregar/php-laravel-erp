<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;

class Insert extends Component
{
    
    public $name;
    public $telepon;
    public $address;
    public $logo;
    public $code;
    public $website;
    public $message;

    protected $rules = [
        'name' => 'required|string',
        'telepon' => 'required|string',
        'address' => 'required|string',
        'logo' => 'required|string',
        'code' => 'required|string',
        'website' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.company.insert');
    }

    public function save(){
        $this->validate();
        
        $data = new Company();
        $data->name = $this->name;
        $data->telepon = $this->telepon;
        $data->address = $this->address;
        $data->logo = $this->logo;
        $data->code = $this->code;
        $data->website = $this->website;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('company');
    }
}
