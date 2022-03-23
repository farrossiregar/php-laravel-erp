<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;


class Add extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employeelist, $employee_name, $employee_id, $date_plan, $start_time_plan, $end_time_plan;

    public function render()
    {
        
        
        
        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        
        $this->regionarealist = [];
        $this->employeelist = $this->employeelist = \App\Models\Employee::whereIn('user_access_id', [85, 84])->get();

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
                                                            ->whereIn('user_access_id', [85, 84])
                                                            ->get();
                
            }else{
                $this->region = '';
                $this->employeelist = \App\Models\Employee::whereIn('user_access_id', [85, 84])->get();
            }
        }
       

        return view('livewire.team-schedule.add');
    }

  
    public function save()
    {


        $data                           = new \App\Models\TeamScheduleNoc();
        $data->company_name             = Session::get('company_id');
        $data->project                  = $this->project;
        
        // $data->client_project_id        = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        
        $dataemployee                   = explode(" - ",$this->employee_name);
        $data->region                   = $this->region;
        $data->name                     = $dataemployee[0];
        $data->nik                      = $dataemployee[1];
        $data->employee_id              = $dataemployee[2];
        
        $data->start_schedule           = $this->date_plan.' '.$this->start_time_plan.':00';
        $data->end_schedule             = $this->date_plan.' '.$this->end_time_plan.':00';
        $data->week                     = $this->weekOfMonth3($this->date_plan);
        $data->save();

        $notif = get_user_from_access('team-schedule.noc-manager');
        foreach($notif as $user){
            if($user->email){
                $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
                $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
            }
        }

       


        session()->flash('message-success',"Team Schedule NOC Berhasil diinput");
        
        return redirect()->route('team-schedule.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



