<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\PpeCheck as PpeCheckModel;

class PpeCheck extends Component
{
    public $date_start,$date_end,$keyword;

    public function render()
    {
        $data = PpeCheckModel::select('ppe_check.*','employees.name')->orderBy('ppe_check.id','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end) $data = $data->whereBetween('ppe_check.created_at',[$this->date_start,$this->date_end]);

        return view('livewire.mobile-apps.ppe-check')->with(['data'=>$data->paginate(100)]);
    }
}
