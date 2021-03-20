<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use App\Models\TroubleTicket;
use Livewire\WithFileUploads;
use App\Mail\CustomerAssetStolenEmail;

class StatusStolenTlp extends Component
{
    use WithFileUploads;

    public $data,$file,$create_trouble_ticket=false,$subject,$description,$trouble_ticket_number,$tt;

    public function render()
    {
        return view('livewire.customer-asset-management.status-stolen-tlp');
    }
    
    public function mount(CustomerAssetManagement $data)
    {
        $this->data = $data;
        $this->tt = TroubleTicket::where(['transaction_id'=>$this->data->id,'transaction_table'=>'customer_asset_management'])->get();
        $this->trouble_ticket_number = "CAM/".date('dmy').'/'. str_pad(TroubleTicket::where(['transaction_table'=>'customer_asset_management'])->count(),5, '0', STR_PAD_LEFT);
    }

    public function save()
    {
        $this->validate([
            'subject' => 'required',
            'description' => 'required',
            'file' => 'required',
        ]);
        $this->create_trouble_ticket = false;

        $tt = new TroubleTicket();
        $tt->trouble_ticket_number = $this->trouble_ticket_number;
        $tt->subject = $this->subject;
        $tt->description = $this->description;
        $tt->transaction_id = $this->data->id;
        $tt->transaction_table = 'customer_asset_management';
        $tt->user_id = \Auth::user()->id;
        $tt->save();

        if($this->file!=""){
            $file = $tt->id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/customer-asset/trouble-ticket',$file);
            $tt->file = $file; 
            $tt->save();
        }
        
        $this->tt = TroubleTicket::where(['transaction_id'=>$this->data->id,'transaction_table'=>'customer_asset_management'])->get();
        
        foreach(get_user_from_access('customer-asset-management.asset-stolen-acknowledge-tlp') as $user){
            $message = "Trouble Ticket : *{$tt->trouble_ticket_number}*\n";
            $message .= "Tower : {$this->data->tower->name}";;
            $message .= "Subject : {$tt->subject}";
            $message .= "Description : {$tt->subject}";

            send_wa(['phone'=>$user->telepon,'message'=>$message]);
            \Mail::to($user->email)->send(new CustomerAssetStolenEmail($data));
        }

        \LogActivity::add('Create Trouble Ticket : '. $tt->id);
    }
}
