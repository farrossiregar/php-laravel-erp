<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\ToolsCheck as ToolsCheckModel;
use App\Models\Toolbox;

class ToolsCheck extends Component
{
    public $employee_id,$tahun,$bulan,$toolboxs;

    public function render()
    {
        $data = ToolsCheckModel::select('tools_check.*','employees.name')->orderBy('tools_check.id','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->tahun) $data->where('tahun',$this->tahun);
        
        if($this->bulan) $data->where('bulan',$this->bulan);

        return view('livewire.mobile-apps.tools-check')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->toolboxs = Toolbox::get();
    }
}