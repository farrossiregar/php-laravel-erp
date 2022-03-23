<?php

namespace App\Http\Livewire\Setting;

use App\Models\Toolbox;
use App\Models\ToolsCheckItem;
use Livewire\Component;

class Tools extends Component
{
    public $name_toolbox;
    protected $listeners = ["refresh-page" => '$refresh'];
    public function render()
    {
        $tools = ToolsCheckItem::get();
        $toolbox = Toolbox::get();

        return view('livewire.setting.tools')->with(['tools'=>$tools,'toolbox'=>$toolbox]);
    }

    public function save_toolbox()
    {
        $data = new Toolbox();
        $data->name = $this->name_toolbox;
        $data->save();
        $this->reset('name_toolbox');
        $this->emitSelf('refresh-page');
    }
}
