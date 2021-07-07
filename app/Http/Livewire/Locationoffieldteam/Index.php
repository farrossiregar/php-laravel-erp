<?php

namespace App\Http\Livewire\Locationoffieldteam;

use Livewire\Component;
use App\Models\LocationOfFieldTeam as modelLocation;

class Index extends Component
{
    public $region_id,$keyword;

    public function render()
    {
        $data = modelLocation::select('location_of_field_teams.*','employees.name')
                                    ->join('employees','employees.id','=','location_of_field_teams.employee_id')
                                    ->groupBy('employee_id')
                                    ->reorder()
                                    ->orderBy('location_of_field_teams.id','DESC');

        if($this->region_id) $data->where('employees.region_id',$this->region_id);
        if($this->keyword) $data->where('employees.name',"LIKE","%{$this->keyword}%");
        
        return view('livewire.locationoffieldteam.index')->with(['data'=>$data->paginate(100)]);
    }

    public function updated()
    {
        $data = modelLocation::select('location_of_field_teams.*','employees.name')
                                    ->join('employees','employees.id','=','location_of_field_teams.employee_id')
                                    ->groupBy('employee_id')
                                    ->reorder()
                                    ->orderBy('location_of_field_teams.id','DESC');

        if($this->region_id) $data->where('employees.region_id',$this->region_id);
        if($this->keyword) $data->where('employees.name',"LIKE","%{$this->keyword}%");
        $data = $data->paginate(100);

        $this->emit('reinit-map',$data);
    }
}
