<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccidentReport;
use App\Models\CommitmentLetter;
use Auth;

class Datahup extends Component
{
    use WithPagination;
    public $date, $employee_id, $keyword,$employees;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        if(!check_access('commitment-letter.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        
        $data = CommitmentLetter::with('project_','region_')->where('company_name', '1')->orderBy('id', 'desc');
        if(check_access('commitment-letter.pic')) $data->where('commitment_letter.pic_project_id',\Auth::user()->employee->id);
        if(check_access('commitment-letter.admin') || check_access('commitment-letter.pic') ){
            if($this->keyword) $data->where(function($table){
                $table->Where('project',"LIKE","%{$this->keyword}%")
                        ->orWhere('region',"LIKE","%{$this->keyword}%")
                        ->orWhere('region_area',"LIKE","%{$this->keyword}%")
                        ->orWhere('employee_name',"LIKE","%{$this->keyword}%")
                        ->orWhere('leader',"LIKE","%{$this->keyword}%")
                        ->orWhere('createdby',"LIKE","%{$this->keyword}%");
            });
            
        }else{
            if($this->keyword) $data->where(function($table){
                $table->Where('employee_name',"LIKE","%{$this->keyword}%");
            });

            $users = Auth::user();
            $data = $data->where(function($table) use ($users){
                        $table->where('employee_name', $users->name)
                        ->orwhere('createdby', $users->name);
                    });
            // $data = $data->where('employee_name', $users->name)->orwhere('createdby', $users->name);
        }
                        
        return view('livewire.commitment-letter.datahup')->with(['data'=>$data->paginate(50)]);
    }

    
}



