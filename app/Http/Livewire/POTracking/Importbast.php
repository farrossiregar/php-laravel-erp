<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importbast extends Component
{
    use WithFileUploads;
    public $file;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking.importbast');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        // if($this->file()){
            // $bast = 'bast'.'1'.date('Ymdhis').'.'.$this->file->extension();
            $bast = 'bast'.'1'.date('Ymdhis').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/bast/',$bast);
            

            $data = \App\Models\PoTrackingReimbursementMaster::where('id', 1)->first();
            $data->approved_bast_erp_date_upload = date('Y-m-d H:i:s');
            $data->save();
        // }

        


        session()->flash('message-success',"Upload Bast success");
        
        return redirect()->route('po-tracking.index');
    }
}
