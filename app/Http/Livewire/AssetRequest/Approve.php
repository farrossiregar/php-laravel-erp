<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapprovehotelflightticket'=>'approvehotelflightticket',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.asset-request.approve');
    }

    public function approvehotelflightticket($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve = $this->selected_id;
        $data = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();
        if($type_approve[1] == '1'){
            $data->status = '1';
        }else{
            $data->status = '2';
        }
        
        
        $data->save();

    
        // $notif = get_user_from_access('asset-request.toc-leader');
        
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Approve </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }



        session()->flash('message-success',"Berhasil, Hotel & Flight Ticket sudah diapprove!!!");
        
        return redirect()->route('asset-request.index');
    }
}
