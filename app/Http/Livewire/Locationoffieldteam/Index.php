<?php

namespace App\Http\Livewire\Locationoffieldteam;

use Livewire\Component;
use App\Models\LocationOfFieldTeam as modelLocation;
use Livewire\WithPagination;
use App\Models\ClientProjectRegion;

class Index extends Component
{
    public $region_id,$keyword,$region;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $project_id;
    protected $queryString = ['project_id'];

    public function render()
    {
        $data = $this->init_data();
        $raw_data = clone $data->get();

        return view('livewire.locationoffieldteam.index')->with(['data'=>$data->paginate(100),'raw_data'=>$raw_data]);
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        $this->region = ClientProjectRegion::select('region.*')
                                                ->where('client_project_id',session()->get('project_id'))
                                                ->join('region','region.id','client_project_region.region_id')
                                                ->groupBy('region.id')
                                                ->get();

        \LogActivity::add('[web] Location of Field Team');
    }

    public function init_data()
    {
        $data = modelLocation::select('location_of_field_teams.*','employees.name','employees.nik')
                                    ->join('employees','employees.id','=','location_of_field_teams.employee_id')
                                    ->groupBy('employee_id')
                                    ->reorder()
                                    ->orderBy('location_of_field_teams.id','DESC');

        if($this->region_id) $data->where('employees.region_id',$this->region_id);
        if($this->keyword) $data->where('employees.name',"LIKE","%{$this->keyword}%");

        return $data;
    }

    public function updated()
    {
        $data = $this->init_data();

        $this->emit('reinit-map',$data->get());
    }
}
