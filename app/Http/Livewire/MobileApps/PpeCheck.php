<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\PpeCheck as PpeCheckModel;

class PpeCheck extends Component
{
    public $employee_id;

    public function render()
    {
        $data = PpeCheckModel::select('ppe_check.*','employees.name')->orderBy('ppe_check.id','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->employee_id) $data->where('employee_id',$this->employee_id);

        return view('livewire.mobile-apps.ppe-check')->with(['data'=>$data->paginate(100)]);
    }
}
