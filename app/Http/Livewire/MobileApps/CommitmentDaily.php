<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\CommitmentDaily as ModelsCommitmentDaily;
use Livewire\WithPagination;

class CommitmentDaily extends Component
{
    public $employee_id,$date_start,$date_end;
    
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = ModelsCommitmentDaily::select('employees.name','commitment_dailys.*')->orderBy('commitment_dailys.id','DESC')->join('employees','employees.id','=','employee_id');

        if($this->employee_id) $data->where('employee_id',$this->employee_id);
        if($this->date_start and $this->date_end) $data = $data->whereBetween('commitment_dailys.created_at',[$this->date_start,$this->date_end]);

        return view('livewire.mobile-apps.commitment-daily')->with(['data'=>$data->paginate(100)]);
    }
}
