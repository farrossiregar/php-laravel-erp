<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importacceptancedocs extends Component
{
    protected $listeners = [
        'modal-acceptancedocs'=>'dataacceptance',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;
    public function render()
    {
        return view('livewire.po-tracking.importacceptancedocs');
    }

    public function dataacceptance($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $accdoc = 'potracking-accdoc'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/AcceptanceDocs/',$accdoc);

            $data = \App\Models\PoTrackingReimbursementAccdocupload::where('po_no', $this->selected_id)
                                                                    ->first();            
            $data->accdoc_filename = $accdoc;
            $data->accdoc_date = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Acceptance Docs PO No ".$this->selected_id." success");

        return redirect()->route('po-tracking.index');
    }
}
