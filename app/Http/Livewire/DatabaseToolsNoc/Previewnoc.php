<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Previewnoc extends Component
{
    protected $listeners = [
        'modalpreviewnoc'=>'datapreview',
    ];
    use WithFileUploads;
    public $selected_id, $data, $year, $month;

    
    public function render()
    {
        $selected_id = $this->selected_id;
        $month = $this->month;
        $year = $this->year;
        return view('livewire.database-tools-noc.previewnoc');
    }

    public function datapreview($id)
    {

        $this->selected_id              = $id;
        $monthyear = explode('-', $this->selected_id);
        $this->month = $monthyear[0];
        $this->year = $monthyear[1];
        
        // $monthyear = explode('-', $id);
        // // dd($monthyear[0]);
        // $this->data                     = \App\Models\Employee::whereYear('resign_date', $monthyear[1])->whereMonth('resign_date', $monthyear[0])->get();


        
        
    }

   

}
