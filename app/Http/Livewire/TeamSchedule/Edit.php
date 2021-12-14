<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use Session;

class Edit extends Component
{
    protected $listeners = [
        'modaleditteamschedule'=>'editteamschedule',
    ];

    use WithFileUploads;
    public $selected_id, $data;
    public $dataproject, $company_name, $project, $region, $employeelist, $employee_name, $date_plan, $start_time_plan, $end_time_plan;
    
    public function render()
    {
        
       
        
        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        
        $this->regionarealist = [];
        $this->employeelist = [];

        if($this->project){ 
            
            $getproject = \App\Models\ClientProject::where('id', $this->project)
                                                    ->where('company_id', Session::get('company_id'))
                                                    ->where('is_project', '1')
                                                    ->first();
            
                                                    
            if($getproject){
                if($getproject->region_id){
                    $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
                }else{
                    $this->region = '';
                }

                $this->employeelist = \App\Models\Employee::where('region_id', $getproject->region_id)
                                                            ->where('project', $this->project)
                                                            ->get();
                
                
            }else{
                $this->region = '';
                $this->employeelist = [];
            }
        }
        
        
        return view('livewire.team-schedule.edit');
        
    }

    public function editteamschedule($id){
        $this->selected_id              = $id;
        $data                           = \App\Models\TeamScheduleNoc::where('id', $this->selected_id)->first();
        $this->project                  = get_project_company($data->project, $data->company_name);
        
        $this->region                   = $data->region;
        
        $this->region                   = $data->region;
        $this->employee_name            = $data->name;
        $this->date_plan                = date_format(date_create($data->start_schedule), 'Y-m-d');
        $this->start_time_plan          = date_format(date_create($data->start_schedule), 'H:i');;
        $this->end_time_plan            = date_format(date_create($data->end_schedule), 'H:i');
        
        
       
    }
  
    public function save()
    {
        $data                           = \App\Models\TeamScheduleNoc::where('id', $this->selected_id)->first();
        $data->company_name               = Session::get('company_id');
        $data->project                  = $this->project;
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->start_schedule           = $this->date_plan.' '.$this->start_time_plan.':00';
        $data->end_schedule             = $this->date_plan.' '.$this->end_time_plan.':00';
        $data->status                   = '';
        $data->save();
        
        
        session()->flash('message-success',"Team Schedule NOC Berhasil diinput");
        
        return redirect()->route('team-schedule.index');
        
    }


    public function yearborn($year){
        if($year > substr(date('Y'), 2, 2)){
            return '19'.$year;
        }else{
            return '20'.$year;
        }

    }
}
