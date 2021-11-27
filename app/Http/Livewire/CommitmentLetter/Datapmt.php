<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccidentReport;
use App\Models\CommitmentLetter;
use Auth;

class Datapmt extends Component
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
        
        
        $data = CommitmentLetter::where('company_name', '2')->orderBy('id', 'desc');
        
                if(check_access('commitment-letter.admin') || check_access('commitment-letter.pic') ){
            if($this->keyword) $data->where(function($table){
                $table->Where('project',"LIKE","%{$this->keyword}%")
                        ->orWhere('region',"LIKE","%{$this->keyword}%")
                        ->orWhere('employee_name',"LIKE","%{$this->keyword}%");
            });
            
        }else{
            if($this->keyword) $data->where(function($table){
                $table->Where('employee_name',"LIKE","%{$this->keyword}%");
            });

            $users = Auth::user();
            $data = $data->where('employee_name', $users->name)->orwhere('createdby', $users->name);
        }
                        
        return view('livewire.commitment-letter.datapmt')->with(['data'=>$data->paginate(50)]);
    }

  
}



