<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsBoq;

class Inputpriceboq extends Component
{
    protected $listeners = [
        'modalinputboqprice'=>'inputPrice',
    ];
    public $input_price;
    public $selected_id;
    
    public function render()
    {
        return view('livewire.po-tracking-nonms.inputpriceboq');
    }

    public function inputPrice($id)
    {
        $this->selected_id = PoTrackingNonmsBoq::find($id);
    }

    public function save()
    {  
        $this->selected_id->input_price = $this->input_price;
        $this->selected_id->profit = 100 - round(($this->input_price / $this->selected_id->price) * 100);
        $this->selected_id->save();

        session()->flash('message-success',"PO Tracking Non MS Boq Price updated success");
        
        return redirect()->route('po-tracking-nonms.edit-boq',['id'=>$this->selected_id->id_po_nonms_master]);
    }
}
