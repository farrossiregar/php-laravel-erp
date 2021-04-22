<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementAccdocupload;

class Importacceptancedocs extends Component
{
    protected $listeners = [
        'modal-acceptancedocs'=>'dataacceptance',
    ];

    use WithFileUploads;
    public $file,$po;
    public function render()
    {
        return view('livewire.po-tracking.importacceptancedocs');
    }

    public function dataacceptance(PoTrackingReimbursement $id)
    {
        $this->po = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $accdoc = 'potracking-accdoc'.$this->po->po_reimbursement_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/AcceptanceDocs/',$accdoc);

            $data = PoTrackingReimbursementAccdocupload::where('po_tracking_reimbursement_id', $this->po->id)->first();           
            if(!$data){
                $data = new PoTrackingReimbursementAccdocupload();
                $data->po_tracking_reimbursement_id = $this->po->id;
            } 
            $data->accdoc_filename = $accdoc;
            $data->accdoc_date = date('Y-m-d H:i:s');
            $data->save();

            $this->po->status = 4; // Done
            $this->po->save();
        }

        session()->flash('message-success',"Upload Acceptance Docs PO No ".$this->po->po_reimbursement_id." success");

        return redirect()->route('po-tracking.index');
    }
}
