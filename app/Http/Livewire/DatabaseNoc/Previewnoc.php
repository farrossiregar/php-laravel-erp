<?php

namespace App\Http\Livewire\DatabaseNoc;

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
    public $selected_id, $data;

    
    public function render()
    {
        
        return view('livewire.database-noc.previewnoc');
    }

    public function datapreview($id)
    {

        $this->selected_id              = $id;
        // // dd($id);
        // $monthyear = explode('-', $id);
        // // dd($monthyear[0]);
        // $this->data                     = \App\Models\Employee::whereYear('resign_date', $monthyear[1])->whereMonth('resign_date', $monthyear[0])->get();


        
        
    }

   

}
