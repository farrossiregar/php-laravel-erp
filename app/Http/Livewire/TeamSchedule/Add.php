<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use Auth;
use DB;
use Session;


class Add extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
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
       

        return view('livewire.team-schedule.add');
    }

  
    public function save()
    {


        $data                           = new \App\Models\TeamScheduleNoc();
        $data->company_name             = Session::get('company_id');
        $data->project                  = $this->project;
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->start_schedule           = $this->date_plan.' '.$this->start_time_plan.':00';
        $data->end_schedule             = $this->date_plan.' '.$this->end_time_plan.':00';
        
        $data->save();

        // $notif = check_access_data('petty-cash.notif', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser_[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear Admin NOC *\n\n";
        //     $message .= "*Petty Cash ".date('M')."-".date('Y')." telah diapprove oleh Finance *\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

       


        session()->flash('message-success',"Team Schedule NOC Berhasil diinput");
        
        return redirect()->route('team-schedule.index');
    }


}



