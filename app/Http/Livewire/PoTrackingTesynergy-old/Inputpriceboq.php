<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Inputpriceboq extends Component
{
    protected $listeners = [
        'modalinputboqprice'=>'inputPrice',
    ];

    use WithFileUploads;
    public $input_price;
    public $selected_id;

    
    public function render()
    {
        return view('livewire.po-tracking-nonms.inputpriceboq');
    }

    public function inputPrice($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
       
        $data = \App\Models\PoTrackingNonmsBoq::where('id', $this->selected_id)->first();
        $data->input_price = $this->input_price;
        $data->profit = 100 - round(($this->input_price / $data->price) * 100);
        $data->save();

        session()->flash('message-success',"PO Tracking Non MS Boq Price updated success");
        
        return redirect()->route('po-tracking-nonms.edit-boq',['id'=>$data->id_po_nonms_master]);
    }
}
