<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Index extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        if(!check_access('accident-report.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        $data = \App\Models\EmployeeNoc::orderBy('month')->orderBy('year');
                                    
        // dd($data);
        // if($this->date) $ata = $data->whereDate('date',$this->date);
                        
        
        return view('livewire.database-noc.index')->with(['data'=>$data->paginate(50)]);

        
    }


}



