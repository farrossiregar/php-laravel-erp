<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importbast extends Component
{
    protected $listeners = [
        'modal-bast'=>'databast',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id, $bast;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking.importbast');
    }

    public function databast($id)
    {
        $this->selected_id = $id;
        $this->data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
        $this->bast = $this->data->approved_bast_erp_date_upload;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $bast = 'bast'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/bast/',$bast);

            $data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
            $data->approved_bast_erp_date_upload = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Bast success");
        
        return redirect()->route('po-tracking.index');
    }
}
