<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementBastupload;

class Importbast extends Component
{
    protected $listeners = [
        'modal-bast'=>'databast',
    ];

    use WithFileUploads;
    public $file,$bast_number,$bast_approved;
    public $po;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking.importbast');
    }

    public function databast(PoTrackingReimbursement $po)
    {
        $this->po = $po;
    }

    public function save()
    {
        $this->validate([
            'bast_number' => 'required',
            'bast_approved' => 'required',
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $bast = 'potracking-bast'.$this->po->po_reimbursement_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/Bast/',$bast);

            $data = PoTrackingReimbursementBastupload::where('po_no', $this->po->po_reimbursement_id)->first();
            if(!$data) {
                $data = new PoTrackingReimbursementBastupload();
                $data->po_no = $this->po->po_reimbursement_id;
            }
            $data->po_tracking_reimbursement_id = $this->po->id;
            $data->bast_filename = $bast;
            $data->bast_date = date('Y-m-d H:i:s');
            $data->save();

            $this->po->bast_number = $this->bast_number;
            $this->po->bast_approved = $this->bast_approved;
            $this->po->status = 1; // change status regional upload BAST
            $this->po->save();
        }

        session()->flash('message-success',"Upload Bast PO No ".$this->po->po_reimbursement_id." success");
        
        return redirect()->route('po-tracking.index');
    }
}
