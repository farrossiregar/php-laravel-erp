<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;
use DB;


class Updateemployee extends Component
{
    use WithPagination;
    public $name, $position;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\Employee::orderBy('id', 'DESC');
        if($this->name) $ata = $data->where(function($table){
                                $table->where('name', 'like', '%' . $this->name . '%')->orWhere('nik', $this->name);
                            });
        if($this->position) $ata = $data->where('user_access_id', 'like', '%' . $this->position . '%');
        
        return view('livewire.duty-roster-flmengineer.updateemployee')->with(['data'=>$data->paginate(100)]);
    }
}