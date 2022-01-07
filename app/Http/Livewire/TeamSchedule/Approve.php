<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveteamschedule'=>'approveteamschedule',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype, $note;

    
    public function render()
    {
        return view('livewire.team-schedule.approve');
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

        $id = $this->selected_id;

        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryteamschedule'.$id[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();

    
        // $notif = get_user_from_access('team-schedule.toc-leader');
        
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Approve </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }



        session()->flash('message-success',"Berhasil, Team Schedule sudah diapprove!!!");
        
        return redirect()->route('team-schedule.index');
    }
}
