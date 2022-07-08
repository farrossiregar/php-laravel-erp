<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use App\Models\Customer;

class Insert extends Component
{
    public $code,$name;

    protected $rules = [ 
        'code' => 'required|string',
        'name' => 'required'
    ];

    public function render()
    {
        return view('livewire.project.insert');
    }

    public function save(){
        $this->validate();
        
        $data = new Project();
        $data->code = $this->code;
        $data->name = $this->name;
        $data->save();

        session()->flash('message-success','Project saved.');

        return redirect()->to('project');
    }
}
