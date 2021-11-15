<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccidentReport;
use App\Models\CommitmentLetter;

class Data extends Component
{
    use WithPagination;
    public $date, $employee_id, $keyword,$employees;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        $data = CommitmentLetter::orderBy('id', 'desc');
        // if($this->date) $ata = $data->whereDate('date',$this->date);
        // if($this->employee_id) $ata = $data->where('employee_id',$this->employee_id);
        if($this->keyword) $data->where(function($table){
            $table->where("company_name","LIKE","%{$this->keyword}%")
                    ->orWhere('project',"LIKE","%{$this->keyword}%")
                    ->orWhere('region',"LIKE","%{$this->keyword}%")
                    ->orWhere('employee_name',"LIKE","%{$this->keyword}%");
        });
                        
        return view('livewire.commitment-letter.data')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $this->employees = AccidentReport::select(['employees.id','employees.name'])->join('employees','employees.id','=','accident_report.employee_id')->whereNotNull('employee_id')->groupBy('employee_id')->get();
    }
}



