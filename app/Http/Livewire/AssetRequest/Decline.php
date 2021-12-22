<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldeclinehotelflightticket'=>'declinehotelflightticket',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.asset-request.decline');
    }

    public function declinehotelflightticket($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
        $data = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        // send notifikasi
        // $notif = get_user_from_access('asset-request.toc-leader');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Decline </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }


        
        session()->flash('message-success',"Berhasil, Hotel & Flight Ticket is Decline !!!");

        // \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('asset-request.index');
    }
}
