<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonms;

class Bast extends Component
{
    use WithFileUploads;
    public $data,$url_generate_bast,$url_generate_esar,$file_bast,$file_gr,$note;
    protected $listeners = [
        'listen-bast'=>'listen_bast',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.bast');
    }

    public function listen_bast(PoTrackingNonms $id)
    {
        $this->data = $id;
        $this->url_generate_bast = route('po-tracking-nonms.generate-bast',$this->data->id); 
        $this->url_generate_esar = route('po-tracking-nonms.generate-esar',$this->data->id); 
    }


    public function approve()
    {
        $this->validate([
            'file_bast'=>'required|mimes:xls,xlsx,pdf|max:51200', // 50MB maksimal
            // 'file_gr'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file_bast){
            $bast = 'pononms-bast'.$this->data->id.'.'.$this->file_bast->extension();
            $this->file_bast->storeAs('public/po_tracking_nonms/bast/',$bast);
            $this->data->bast = "storage/po_tracking_nonms/bast/{$bast}";
            $this->data->bast_status  = 2;
            $this->data->bast_status_note  = $this->note;
            $this->data->save();
        }
        if($this->file_gr){
            $grcust = 'pononms-grcust'.$this->data->id.'.'.$this->file_gr->extension();
            $this->file_gr->storePubliclyAs('public/po_tracking_nonms/GrCust/',$grcust);
            $this->data->gr_cust = $grcust;
            $this->data->save();
        }

        $this->bast_status = 2; // Approve
        $this->data->status = 7; // E2E Review
        $this->data->bast_status_note = $this->note;
        $this->data->save();

        session()->flash('message-success',"Upload Bast PO Tracking Non MS success");
        return redirect()->route('po-tracking-nonms.index');
    }

    public function revisi()
    {
        $this->validate([
            'note' => 'required'
        ]);
        
        $this->data->bast_status = 3; // Revisi
        $this->data->bast_status_note = $this->note;
        $this->data->save();

        session()->flash('message-success',"Bast PO Tracking Non MS Submited");
        return redirect()->route('po-tracking-nonms.index');
    }
}
