<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use App\Models\ToolboxLaptop;

class ToolsLaptop extends Component
{
    public $name;
    
    protected $listeners = ["refresh-page" => '$refresh'];

    public function render()
    {
        $laptop = ToolboxLaptop::get();

        return view('livewire.setting.tools-laptop')->with(['laptop'=>$laptop]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required'
        ]);
        
        $data = new ToolboxLaptop();
        $data->name = $this->name;
        $data->save();

        $this->reset('name');
        $this->emitSelf('refresh-page');
    }
}
