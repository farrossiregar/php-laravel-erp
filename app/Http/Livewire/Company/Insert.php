<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use Livewire\WithFileUploads;

class Insert extends Component
{
    use WithFileUploads;
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
        'logo' => 'required',
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
        if($this->logo!=""){
            $logo = 'logo'.$this->code.date('Ymdhis').'.'.$this->logo->extension();
            $this->logo->storePubliclyAs('public/logo/',$logo);
            $data->logo = $logo;
        }
        // $data->logo = $this->logo;
        $data->code = $this->code;
        $data->website = $this->website;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('company');
    }
}
