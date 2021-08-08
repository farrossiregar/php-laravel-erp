<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = Employee::orderBy('month')->orderBy('year');
                                    
        if($this->date) $ata = $data->where('month',$this->month)
                                    ->where('year',$this->year);

        return view('livewire.database-noc.data')->with(['data'=>$data->paginate(50)]);   
    }
}