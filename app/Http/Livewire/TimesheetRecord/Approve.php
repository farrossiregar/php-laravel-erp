<?php

namespace App\Http\Livewire\TimesheetRecord;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveteamschedule'=>'approveteamschedule',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.timesheet-record.approve');
    }

    public function approveteamschedule($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve = $this->selected_id;
        $data = \App\Models\TeamScheduleNoc::where('id', $this->selected_id)->first();
        if($type_approve[1] == '1'){
            $data->status = '1';
            $data->start_actual = $data->start_schedule;
            $data->end_actual = $data->end_schedule;
        }else{
            $data->status = '2';
        }
        
        
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



        session()->flash('message-success',"Berhasil, Petty Cash sudah diapprove!!!");
        
        return redirect()->route('team-schedule.index');
    }
}
