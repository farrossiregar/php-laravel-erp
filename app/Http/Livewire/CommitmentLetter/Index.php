<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Index extends Component
{
    use WithPagination;
    public $date, $employee_id, $site_id;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        if(!check_access('accident-report.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        // $data = \App\Models\AccidentReport::orderBy('id', 'desc');
        // if($this->date) $ata = $data->whereDate('date',$this->date);
        // if($this->employee_id) $ata = $data->where('employee_id',$this->employee_id);
        // if($this->site_id) $ata = $data->where('site_id',$this->site_id);
                        
        
        // return view('livewire.accident-report.index')->with(['data'=>$data->paginate(50)]);

        return view('livewire.commitment-letter.index');

        
    }


}



