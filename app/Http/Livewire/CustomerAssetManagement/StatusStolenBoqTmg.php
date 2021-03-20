<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use Livewire\WithFileUploads;

class StatusStolenBoqTmg extends Component
{
    use WithFileUploads;

    public $data,$file;

    public function render()
    {
        return view('livewire.customer-asset-management.status-stolen-boq-tmg');
    }

    public function mount(CustomerAssetManagement $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $this->validate([
            'file' => 'required'
        ]);
        
        \LogActivity::add('Upload BOQ : '. $this->data->id);

        if($this->file!=""){
            $file = $this->data->id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/customer-asset/boq',$file);
            $this->data->file_boq = $file;
            $this->data->status = 4; // Checklist 
            $this->data->save();
        }

        $this->emit('refresh-page');
    }
}
