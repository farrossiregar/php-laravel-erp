<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;
use Livewire\WithFileUploads;

class PoDetail extends Component
{
    use WithFileUploads;

    public $data,$is_e2e,$gr_file,$bast_file,$bast_note,$file_extra_budget;
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

    public function upload()
    {
        $this->validate([
            'file_extra_budget'=>'required|mimes:jpeg,png,jpg,gif,svg,pdf,xls,xlsx|max:2048',
        ]);

        $file_name =  "extra_budget.".$this->file_extra_budget->extension();
        $this->file_extra_budget->storeAs("public/po-tracking-nonms/{$this->data->id}", $file_name);
        
        $this->data->extra_budget_file = "storage/po-tracking-nonms/{$this->data->id}/{$file_name}";
        $this->data->save();

        \LogActivity::add('[web] PO Fuel Reimbursement - Upload bukit Transfer - Extra Budget');

        $this->emit('message-success',"Uploaded");
        $this->emit('refresh');
        $this->emit('modal','hide');   
    }
}
