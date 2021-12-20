<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use App\Models\TroubleTicket;
use Livewire\WithFileUploads;
use App\Mail\CustomerAssetStolenEmail;
use App\Mail\GeneralEmail;

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
        $tt->employee_id = \Auth::user()->employee->id;
        $tt->status = 1;
        $tt->tanggal_kejadian = date('Y-m-d');
        $tt->trouble_ticket_category = 'PROBLEM IT LAINNYA (JELASKAN)';
        $tt->lokasi = "Diluar Kantor / Remote";
        $tt->transaction_table = 'customer_asset_management';
        $tt->transaction_id = $this->data->id;
        $tt->save();

        if($this->file!=""){
            $name = $tt->id.'.'.$this->file->extension();
            $this->file->storePubliclyAs("public/trouble-ticket/{$tt->id}",$name);
            $tt->file = "storage/trouble-ticket/{$tt->id}/{$name}";
            $tt->save();
        }
        
        $this->tt = TroubleTicket::where(['transaction_id'=>$this->data->id,'transaction_table'=>'customer_asset_management'])->get();
        
        $message = "Trouble Ticket : *{$tt->trouble_ticket_number}*\n";
        $message .= "Tower : {$this->data->tower->name}";;
        $message .= "Subject : {$tt->subject}";
        $message .= "Description : {$tt->subject}";

        if(isset($this->data->employee->email)) \Mail::to($this->data->employee->email)->send(new GeneralEmail('[PMT E-PM] Customer Asset - Create Trouble Ticket '. $tt->trouble_ticket_number,$message));

        foreach(get_user_from_access('customer-asset-management.asset-stolen-acknowledge-tlp') as $user){
            \Mail::to($user->email)->send(new GeneralEmail('[PMT E-PM] Customer Asset - Create Trouble Ticket '. $tt->trouble_ticket_number,$message));
        }

        \LogActivity::add('[web] Create Trouble Ticket : '. $tt->id);
    }
}