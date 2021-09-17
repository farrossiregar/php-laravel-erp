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
        $data = ModelsCommitmentDaily::orderBy('id','DESC');

        if($this->employee_id) $data->where('employee_id',$this->employee_id);
        if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);

        return view('livewire.mobile-apps.commitment-daily')->with(['data'=>$data->paginate(100)]);
    }
}
