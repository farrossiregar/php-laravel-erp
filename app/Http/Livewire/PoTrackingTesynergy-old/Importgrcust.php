<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importgrcust extends Component
{
    protected $listeners = [
        'modalimportgrcust'=>'datagrcust',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importgrcust');
    }

    public function datagrcust($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $grcust = 'pononms-grcust'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_nonms/GrCust/',$grcust);

            $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)
                                                                    ->first();
            $data->gr_cust = $grcust;
            // $data->bast_date = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload GR Customer PO Tracking Non MS success");
        
        return redirect()->route('po-tracking-nonms.edit-bast',['id'=>$data->id]);
    }
}
