<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\PoTrackingNonmsPo;
use App\Models\PoTrackingNonms;

class AddPo extends Component
{
    public $wos=[],$error_message='',$po_number,$date_po,$contract,$date_contract,$po_line_item;
    public $wo_list=[],$wo_id=[],$works;
    public function render()
    {    
        return view('livewire.po-tracking-nonms.add-po');
    }

    public function mount()
    {
        $this->wo_list = PoTrackingNonms::whereNull('po_tracking_nonms_po_id')->get();
    }

    public function updated()
    {
        if($this->wo_id) $this->wo_list = PoTrackingNonms::whereNull('po_tracking_nonms_po_id')->get();
        // if($this->wo_id) $this->wo_list = PoTrackingNonms::whereNull('po_tracking_nonms_po_id')->whereNotIn('id',$this->wo_id)->get();
    }

    public function delete_wo($k)
    {
        unset($this->wo_id[$k]);
    }

    public function save()
    {
        if(!$this->wos) return $this->error_message = "WO Number required";
        
        $this->validate([
            // 'po_number' => ['required',Rule::unique('po_tracking_nonms_po')],
            'po_number' => ['required'],
            // 'po_line_item' => ['required',Rule::unique('po_tracking_nonms_po')],
            'date_po' => 'required'
        ]);

        $payment_amount = PoTrackingNonms::whereIn('po_tracking_nonms_master.id',$this->wo_id)
                            ->join('po_tracking_nonms_boq','po_tracking_nonms_boq.id_po_nonms_master','=','po_tracking_nonms_master.id')->sum('po_tracking_nonms_boq.total_price');
        
        $po = new PoTrackingNonmsPo();
        $po->po_number = $this->po_number;
        $po->date_po_sc = $this->date_po;
        $po->date_po_sys = date('Y-m-d');
        $po->contract = $this->contract;
        $po->date_contract = $this->date_contract;
        $po->payment_amount = $payment_amount;
        $po->works = $this->works;
        $po->save();

        foreach($this->wo_id as $k => $i){
            $wo = PoTrackingNonms::find($i);
            $wo->po_tracking_nonms_po_id = $po->id;
            $wo->save();
        }

        session()->flash('message-success',"PO Number submitted");

        return redirect()->route('po-tracking-nonms.index');
    }

    public function add_wo()
    {
        $this->wos[] = null;$this->wo_id[]=null;
        $this->error_message = '';
    }
}
