<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;

class Inputpono extends Component
{
    protected $listeners = ['set_wo'];
    use WithFileUploads;
    public $po_no,$date_po,$data=[],$contract,$date_contract;
    public $wo_id;
    
    public function render()
    {
        return view('livewire.po-tracking-nonms.inputpono');
    }

    public function set_wo($id)
    {
        $this->wo_id = $id;
        $this->data = PoTrackingNonms::whereIn('id',$this->wo_id)->get();
    }

    public function save()
    {
        foreach($this->wo_id as $item){   
            $data = PoTrackingNonms::find('id', $item->id);
            $data->po_no = $this->po_no;
            $data->date_po_released = $this->date_po;
            $data->date_po_system = date('Y-m-d');
            $data->save();
        }

        \LogActivity::add('[web] PO Non MS - Input PO No');

        session()->flash('message-success',"PO No updated success");
        
        return redirect()->route('po-tracking-nonms.index');
    }

    public function delete_bast($id)
    {
        PoTrackingNonmsBast::where('id',$id)->delete();
        $this->data = PoTrackingNonms::whereIn('id',$this->wo_id)->get();
    }
}
