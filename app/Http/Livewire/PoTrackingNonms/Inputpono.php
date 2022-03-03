<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Inputpono extends Component
{
    protected $listeners = [
        'modalinputpono'=>'inputpono',
    ];

    use WithFileUploads;
    public $po_no,$date_po;
    public $selected_id;
    
    public function render()
    {
        return view('livewire.po-tracking-nonms.inputpono');
    }

    public function inputpono($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();
        $data->po_no = $this->po_no;
        $data->date_po_released = $this->date_po;
        $data->date_po_system = date('Y-m-d');
        $data->save();

        \LogActivity::add('[web] PO Non MS - Input PO No');

        session()->flash('message-success',"PO No updated success");
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
