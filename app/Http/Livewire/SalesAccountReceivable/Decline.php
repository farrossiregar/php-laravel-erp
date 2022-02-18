<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldeclineaccountpayable'=>'modaldeclineaccountpayable',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.sales-account-receivable.decline');
    }

    public function modaldeclineaccountpayable($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
        $data = \App\Models\AccountPayable::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryaccountpayable'.$this->selected_id;
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();

        // send notifikasi
        // $notif = get_user_from_access('hotel-flight-ticket.toc-leader');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Decline </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }


        
        session()->flash('message-success',"Berhasil, Request Account Payable is Decline !!!");

        // \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('sales-account-receivable.index');
    }
}
