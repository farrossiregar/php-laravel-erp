<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $month, $year, $yr;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        $this->yr = \App\Models\DutyrosterFlmengineerMaster::select(DB::Raw('year(created_at) as yr'))->groupBy(DB::Raw('year(created_at)'))->get();
        // $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
        $data = \App\Models\DutyrosterFlmengineerMaster::orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                        ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id');
        if($this->month) $ata = $data->where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'),$this->month);
        if($this->year) $ata = $data->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'),$this->year);
        // dd($data->get());                                                        
        
        
        
        return view('livewire.duty-roster-flmengineer.data')->with(['data'=>$data->paginate(50)]);
        // return view('livewire.duty-roster-flmengineer.data');

        
    }


}



