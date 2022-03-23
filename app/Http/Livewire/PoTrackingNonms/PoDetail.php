<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;
use Livewire\WithFileUploads;

class PoDetail extends Component
{
    use WithFileUploads;

    public $data,$is_e2e,$gr_file,$bast_file,$bast_note;
    public $is_finance;
    public function render()
    {
        return view('livewire.po-tracking-nonms.po-detail');
    }

    public function mount(PoTrackingNonmsPo $id)
    {
        $this->data = $id;
        $this->is_e2e = check_access('is-e2e');
        $this->is_finance = check_access('is-finance');
    }

    public function approve_bast()
    {
        $this->validate([
            'bast_file'=>'required|mimes:xls,xlsx,pdf|max:51200', // 50MB maksimal
            'gr_file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->bast_file){
            $bast = 'bast'.$this->data->id.'.'.$this->bast_file->extension();
            $this->bast_file->storePubliclyAs("public/po_tracking_nonms/{$this->data->id}/",$bast);
            $this->data->bast_file = "storage/po_tracking_nonms/{$this->data->id}/{$bast}";
        }

        if($this->gr_file){
            $gr = 'gr'.$this->data->id.'.'.$this->gr_file->extension();
            $this->bast_file->storePubliclyAs("public/po_tracking_nonms/{$this->data->id}/",$gr);
            $this->data->gr_file = "storage/po_tracking_nonms/{$this->data->id}/{$gr}";
        }

        $this->data->bast_note = $this->bast_note;
        $this->data->status = 4; // approve 
        $this->data->save();

        $this->emit('message-success','BAST Approve.');
    }

    public function revisi_bast()
    {
        $this->validate([
            'bast_file'=>'required|mimes:xls,xlsx,pdf|max:51200', // 50MB maksimal
            'gr_file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->bast_file){
            $bast = 'bast'.$this->data->id.'.'.$this->bast_file->extension();
            $this->bast_file->storePubliclyAs("public/po_tracking_nonms/{$this->data->id}/",$bast);
            $this->data->bast_file = "storage/po_tracking_nonms/{$this->data->id}/{$bast}";
        }

        if($this->gr_file){
            $gr = 'gr'.$this->data->id.'.'.$this->gr_file->extension();
            $this->bast_file->storePubliclyAs("public/po_tracking_nonms/{$this->data->id}/",$gr);
            $this->data->gr_file = "storage/po_tracking_nonms/{$this->data->id}/{$gr}";
        }

        $this->data->bast_note = $this->bast_note;
        $this->data->status = 3; // approve 
        $this->data->save();

        $this->emit('message-success','BAST Revisi.');
    }
}
