<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importapprovedbast extends Component
{
    protected $listeners = [
        'modal-bast'=>'databast',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importbast');
    }

    public function databast($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $bast = 'potracking-bast'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_nonms/Bast/',$bast);

            $data = \App\Models\PoTrackingReimbursementBastupload::where('po_no', $this->selected_id)
                                                                    ->first();
            $data->bast_filename = $bast;
            $data->bast_date = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Bast PO No ".$this->selected_id." success");
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
