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
        $data->status = '1';
        $data->save();

        // send notif to SM
        if(isset($data->employee->email)) {
            $message = "<p>Dear {$data->employee->name}<br />Your site approved Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
            \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
        }

        $notif = get_user_from_access('duty-roster.audit');
        foreach($notif as $user){
            if($user->email){
                $message = "<p>Dear {$data->employee->name}<br />Duty Roster Site List need check Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
                \Mail::to($data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
            }
        }
        // $notif = check_access_data('duty-roster.notif-approve', '');
        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear SRM *\n\n";
        //     $message .= "*Duty Roster Sitelist dengan id ".$this->selected_id." telah diapprove oleh Admin Project *\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


        session()->flash('message-success',"Berhasil, Duty Roster sudah diapprove!!!");
        
        return redirect()->route('duty-roster.index');
    }
}
