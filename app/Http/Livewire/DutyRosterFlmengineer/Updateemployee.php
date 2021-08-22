<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;
use DB;


class Updateemployee extends Component
{
    use WithPagination;
    public $data, $name, $position;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        // $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
        $data = \App\Models\Employee::orderBy('id', 'DESC');
        if($this->name) $ata = $data->where('name', 'like', '%' . $this->name . '%');
        if($this->position) $ata = $data->where('user_access_id', 'like', '%' . $this->position . '%');
        
        $data = $data->get();
        $this->data = $data;
     
                        
        
        // return view('livewire.duty-roster-flmengineer.updateemployee')->with(['data'=>$data->paginate(50)]);
        return view('livewire.duty-roster-flmengineer.updateemployee');

        
    }


}



