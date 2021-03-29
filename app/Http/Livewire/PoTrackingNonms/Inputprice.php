<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Inputprice extends Component
{
    protected $listeners = [
        'modalinputstpprice'=>'inputPrice',
    ];

    use WithFileUploads;
    public $input_price;
    public $selected_id;

    
    public function render()
    {
        return view('livewire.po-tracking-nonms.inputprice');
    }

    public function inputPrice($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
       
        $data = \App\Models\PoTrackingNonmsStp::where('id', $this->selected_id)->first();
        $data->input_price = $this->input_price;
        $data->profit = 100 - round(($this->input_price / $data->price) * 100);
        $data->save();
        // if($this->file){
        //     $bast = 'potracking-bast'.$this->selected_id.'.'.$this->file->extension();
        //     $this->file->storePubliclyAs('public/po_tracking/Bast/',$bast);

        //     $data = \App\Models\PoTrackingReimbursementBastupload::where('po_no', $this->selected_id)
        //                                                             ->first();
        //     $data->bast_filename = $bast;
        //     $data->bast_date = date('Y-m-d H:i:s');
        //     $data->save();
        // }

        session()->flash('message-success',"Upload Bast PO No ".$this->selected_id." success");
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
