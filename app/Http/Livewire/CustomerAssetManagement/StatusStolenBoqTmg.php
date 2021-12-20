<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class StatusStolenBoqTmg extends Component
{
    use WithFileUploads;

    public $data,$file;

    public function render()
    {
        return view('livewire.customer-asset-management.status-stolen-boq-tmg');
    }

    public function mount(CustomerAssetManagementHistory $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $this->validate([
            'file' => 'required'
        ]);
        
        \LogActivity::add('[web] Upload BOQ : '. $this->data->id);
        
        if($this->file){
            $file = $this->data->id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/customer-asset/boq',$file);
            $this->data->file_boq = $file;
            $this->data->status = 3; // Checklist
            $this->data->save();
        }

        // send notifikasi
        if(isset($this->data->employee->email)){
            $message = "<p>Dear {$this->data->employee->name}<br />Customer Asset upload BOQ by Service Manager</p>";
            // \Mail::to($this->data->employee->email)->send(new GeneralEmail("[PMT E-PM] - Custome Asset",$message));
            \Mail::to('doni.enginer@gmail.com')->send(new GeneralEmail("[PMT E-PM] - Custome Asset",$message));
        }

        $this->emit('refresh-page');
    }
}