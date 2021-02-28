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
            'file'=>'required|mimes:pdf|max:51200' // 50MB maksimal
        ]);


        if($this->file){
            $acceptancedocs = 'acceptancedocs'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/acceptancedocs/',$acceptancedocs);

            $data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
            $data->approved_acceptance_docs_date_upload = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Acceptance Docs success");

        return redirect()->route('po-tracking.index');
    }
}
