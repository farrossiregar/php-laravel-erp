<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importaccdoc extends Component
{
    protected $listeners = [
        'modalimportaccdoc'=>'dataacceptance',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;
    public function render()
    {
        return view('livewire.po-tracking-nonms.importaccdoc');
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
            $accdoc = 'potrackingnonms-accdoc'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_nonms/AcceptanceDocs/',$accdoc);

            $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)
                                                                    ->first();            
            $data->acc_doc = $accdoc;
            // $data->accdoc_date = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Acceptance Docs success");

        return redirect()->route('po-tracking-nonms.index');
    }
}
