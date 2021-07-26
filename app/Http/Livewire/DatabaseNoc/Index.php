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

        if(!check_access('database-noc.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        $data = \App\Models\EmployeeNoc::orderBy('month')->orderBy('year');
                                    
        
        if($this->date) $ata = $data->where('month',date_format(date_create($this->date), 'm'))
                                    ->where('year',date_format(date_create($this->date), 'Y'));
                        
        
        return view('livewire.database-noc.index')->with(['data'=>$data->paginate(50)]);

        
    }


}



