<?php

namespace App\Http\Livewire\HotelFlightTicket;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldeclineteamschedule'=>'declineteamschedule',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.hotel-flight-ticket.decline');
    }

    public function declineteamschedule($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
        $data = \App\Models\TeamScheduleNoc::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();


        // $notif_user_psm = check_access_data('database-noc.notif-psm', '');
        // $nameuser_psm = [];
        // $emailuser_psm = [];
        // $phoneuser_psm = [];
        // foreach($notif_user_psm as $no => $itemuser){
        //     $nameuser_psm[$no] = $itemuser->name;
        //     $emailuser_psm[$no] = $itemuser->email;
        //     $phoneuser_psm[$no] = $itemuser->telepon;

        //     $message = "*Dear PSM *\n\n";
        //     $message .= "*Database NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
        //     send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        // send notifikasi
        $notif = get_user_from_access('hotel-flight-ticket.toc-leader');
        foreach($notif as $user){
            if($user->email){
                $message  = "<p>Dear {$user->name}<br />, Team Schedule is Decline </p>";
                $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
            }
        }


        
        session()->flash('message-success',"Berhasil, Team Schedule is Decline !!!");

        \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('hotel-flight-ticket.index');
    }
}
