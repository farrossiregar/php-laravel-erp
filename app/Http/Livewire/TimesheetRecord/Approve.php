<?php

namespace App\Http\Livewire\TimesheetRecord;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapprovetimesheetrecord'=>'approvetimesheetrecord',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.timesheet-record.approve');
    }

    public function approvetimesheetrecord($id)
    {
        $this->selected_id = $id;
        
    }

  
    public function save()
    {
        // dd($this->selected_id);
        $data_approve = $this->selected_id;
        if($data_approve[0] == ''){
            $data = new \App\Models\TimesheetRecord();
            $data->company_name = $data_approve[1]; 
            $data->status = $data_approve[2]; 
            $data->region = $data_approve[3]; 
            $data->project = $data_approve[4]; 
            $data->month = $data_approve[5]; 
            $data->year = $data_approve[6]; 

            $data->save();
        }else{
            $data = \App\Models\TimesheetRecord::where('company_name', $data_approve[1])->where('region', $data_approve[3])->where('project', $data_approve[4])->first();
            $data->status = $data_approve[2];

            $data->save();
        }
        // $type_approve = $this->selected_id;
        // $data = \App\Models\TeamScheduleNoc::where('id', $this->selected_id)->first();
        // if($type_approve[1] == '1'){
        //     $data->status = '1';
        //     $data->start_actual = $data->start_schedule;
        //     $data->end_actual = $data->end_schedule;
        // }else{
        //     $data->status = '2';
        // }
        
        
        // $data->save();

    
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



        session()->flash('message-success',"Berhasil, Timesheet Record sudah diapprove!!!");
        
        return redirect()->route('timesheet-record.index');
    }
}
