<?php

namespace App\Http\Livewire\DutyRoster;

use App\Mail\GeneralEmail;
use Livewire\Component;
use Livewire\WithFileUploads;

class Approvedutyroster extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    public function render()
    {
        return view('livewire.duty-roster.approvedutyroster');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    } 

    public function save()
    {
        $data = \App\Models\DutyrosterSitelistMaster::where('id', $this->selected_id)->first();
        $data->status = 2;
        $data->save();

        // send notif to SM
        if(isset($data->employee->email)) {
            $message = "<p>Dear {$data->employee->name}<br />Your site is approved Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
        }

        $notif = get_user_from_access('duty-roster.audit');
        foreach($notif as $user){
            if($user->email){
                $message = "<p>Dear {$user->name}<br />Duty Roster Site List need check Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
            }
        }

        session()->flash('message-success',"Berhasil, Duty Roster sudah diapprove!!!");
        
        return redirect()->route('duty-roster.index');
    }
}
