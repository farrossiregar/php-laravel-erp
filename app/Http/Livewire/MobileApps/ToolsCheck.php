<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\ToolsCheck as ToolsCheckModel;

class ToolsCheck extends Component
{
    public $employee_id,$tahun,$bulan;

    public function render()
    {
        $data = ToolsCheckModel::orderBy('id','DESC');
        
        if($this->tahun) $data->where('tahun',$this->tahun);
        
        if($this->bulan) $data->where('bulan',$this->bulan);

        return view('livewire.mobile-apps.tools-check')->with(['data'=>$data->paginate(100)]);
    }
}