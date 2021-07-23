<?php

namespace App\Http\Livewire\AccidentReport;

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
        
    //     if(!check_access('po-tracking-nonms.index')){
    //         session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
    //         $this->redirect('/');
    //     }
        
        $data = \App\Models\AccidentReport::orderBy('id', 'desc');
        if($this->date) $ata = $data->whereDate('date',$this->date);
                        
        
        return view('livewire.accident-report.index')->with(['data'=>$data->paginate(50)]);

        
    }


}



