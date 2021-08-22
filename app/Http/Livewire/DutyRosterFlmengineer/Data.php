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
    public $month, $year, $yr, $data_id, $level;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        $this->yr = \App\Models\DutyrosterFlmengineerMaster::select(DB::Raw('year(created_at) as yr'))->groupBy(DB::Raw('year(created_at)'))->get();
        // $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
        $data = \App\Models\DutyrosterFlmengineerMaster::select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy')
                                                        ->orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                        ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id');
        if($this->month) $ata = $data->where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'),$this->month);
        if($this->year) $ata = $data->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'),$this->year);


        return view('livewire.duty-roster-flmengineer.data')->with(['data'=>$data->paginate(50)]);

        
    }

    public function mount(){
        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }
         $data = \App\Models\DutyrosterFlmengineerMaster::select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy')
                                                        ->orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                        ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id');
        if($this->month) $ata = $data->where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'),$this->month);
        if($this->year) $ata = $data->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'),$this->year);
        
        $remarks = $data;
        foreach($remarks->where('dutyroster_flmengineer_master.remarks', '1')->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
        
    }

    public function checkdata($id)
    {
        $check = \App\Models\DutyrosterFlmengineerMaster::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }


}



