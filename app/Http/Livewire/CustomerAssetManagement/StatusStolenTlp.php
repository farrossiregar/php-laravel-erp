<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use App\Models\CustomerAssetManagementHistory;
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
    
    public function mount(CustomerAssetManagementHistory $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $this->validate([
            'file' => 'required',
        ]);

        \LogActivity::add('[web] Upload TLP : '. $this->data->id);
        
        if($this->file){
            $file = $this->data->id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/customer-asset/boq',$file);
            $this->data->file_boq = '/storage/customer-asset/boq/'.$file;
            $this->data->status = 3; // Checklist
            $this->data->save();
        }

        // // send notifikasi
        // if(isset($this->data->employee->email)){
        //     $message = "<p>Dear {$this->data->employee->name}<br />Customer Asset upload BOQ by Service Manager</p>";
        //     \Mail::to($this->data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Custome Asset",$message));
        // }

        $this->emit('refresh-page');

        
        // $this->tt = TroubleTicket::where(['transaction_id'=>$this->data->id,'transaction_table'=>'customer_asset_management'])->get();
        
        // $message = "Trouble Ticket : *{$tt->trouble_ticket_number}*\n";
        // $message .= "Tower : {$this->data->tower->name}";;
        // $message .= "Subject : {$tt->subject}";
        // $message .= "Description : {$tt->subject}";

        // if(isset($this->data->employee->email)) \Mail::to($this->data->employee->email)->send(new GeneralEmail('[PMT E-PM] Customer Asset - Create Trouble Ticket '. $tt->trouble_ticket_number,$message));

        // foreach(get_user_from_access('customer-asset-management.asset-stolen-acknowledge-tlp') as $user){
        //     \Mail::to($user->email)->send(new GeneralEmail('[PMT E-PM] Customer Asset - Create Trouble Ticket '. $tt->trouble_ticket_number,$message));
        // }

        // \LogActivity::add('[web] Create Trouble Ticket : '. $tt->id);
    }
}