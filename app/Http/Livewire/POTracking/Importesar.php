<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;

class Importesar extends Component
{
    protected $listeners = [
        'modalesarupload'=>'dataesar',
    ];

    use WithFileUploads;
    
    public $file;

    public $po;

    public function render()
    {
        return view('livewire.po-tracking.importesar');
    }

    public function dataesar(PoTrackingReimbursement $po)
    {
        $this->po = $po;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:pdf|max:51200' // 50MB maksimal
        ]);
 
        if($this->file){
            $esar = 'Approved-Esar-'.$this->po->po_reimbursement_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/ApprovedEsar/',$esar);

            $data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_id', $this->po->id)->first();
            if(!$data){
                $data = new PoTrackingReimbursementEsarupload();
                $data->po_no = $this->po->po_reimbursement_id;
            }
            $data->po_tracking_reimbursement_id = $this->po->id;
            $data->approved_esar_filename           = $esar;
            $data->approved_esar_uploader_userid    = '18';
            $data->approved_esar_date               = date('Y-m-d H:i:s');
            $data->save();
        }

        $this->po->status = 3; // upload approved 
        $this->po->save();

        session()->flash('message-success',"Upload Approved ESAR success");

        return redirect()->route('po-tracking.index');
    }
}
