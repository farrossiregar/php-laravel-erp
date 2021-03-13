<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use File;

class Importesar extends Component
{
    protected $listeners = [
        'modalesarupload'=>'dataesar',
    ];

    use WithFileUploads;
    
    public $file;
    public $selected_id;

    public function render()
    {
        return view('livewire.po-tracking.importesar');
    }

    public function dataesar($id)
    {
        $this->selected_id = $id;

        // $this->data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
        // // $this->data_po = \App\Models\PoTrackingReimbursement::select('po_no')->where('id_po_tracking_master', $this->selected_id)->groupBy('po_no')->get();
        // $this->approvedesar = $this->data->approved_esar_date_upload;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:pdf|max:51200' // 50MB maksimal
        ]);


        dd($this->selected_id);

        if($this->file){
           
            $esar = 'Approved-Esar-'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/ApprovedEsar/',$esar);

            $data                                   = \App\Models\PoTrackingReimbursementEsarupload::where('po_no', $this->selected_id)->first();
            $data->approved_esar_filename           = 'po-tracking-reimbursement1091188627.pdf';
            $data->approved_esar_uploader_userid    = '18';
            $data->approved_esar_date               = date('Y-m-d H:i:s');
            $data->save();
        }

        

        session()->flash('message-success',"Upload Approved ESAR success");

        return redirect()->route('po-tracking.index');
    }
}
