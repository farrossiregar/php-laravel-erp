<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importapprovedbast extends Component
{
    protected $listeners = [
        'modalimportapprovedbast'=>'dataapprovedbast',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importapprovedbast');
    }

    public function dataapprovedbast($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $approvedbast = 'pononms-approvedbast'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_nonms/ApprovedBast/',$approvedbast);

            $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)
                                                                    ->first();
            $data->approved_bast = $approvedbast;
            $data->bast_status = '1';
            // $data->bast_date = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Bast PO Tracking Non MS success");
        
        return redirect()->route('po-tracking-nonms.edit-bast',['id'=>$data->id]);
    }
}
