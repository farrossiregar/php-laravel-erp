<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveaccountpayable'=>'modalapproveaccountpayable',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.sales-account-receivable.approve');
    }

    public function modalapproveaccountpayable($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve       = $this->selected_id;
        $data               = \App\Models\AccountPayable::where('id', $type_approve[0])->first();
        $data->status       = $type_approve[1];
        $data->note         = $this->note;
        $data->save();

        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryaccountpayable'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();

    
        // $notif = get_user_from_access('sales-account-receivable.toc-leader');
        
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Approve </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }



        session()->flash('message-success',"Berhasil, Request Account Payable sudah diapprove!!!");
        
        return redirect()->route('sales-account-receivable.index');
    }
}
