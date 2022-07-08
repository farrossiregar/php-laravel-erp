<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\PoTrackingNonmsPo;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBoq;

class AddPo extends Component
{
    public $wos=[],$error_message='',$po_number,$date_po,$contract,$date_contract,$po_line_item;
    public $wo_list=[],$wo_id=[],$works,$wo_line_item=[];
    public function render()
    {    
        return view('livewire.po-tracking-nonms.add-po');
    }

    public function mount()
    {
        $this->wo_list = PoTrackingNonms::get();
        $this->date_po = date('Y-m-d');
        $this->date_contract = date('Y-m-d');
    }

    public function updated()
    {
        // if($this->wo_id) $this->wo_list = PoTrackingNonms::whereIn('po_status',[0,1])->get();
        if($this->wo_id) $this->wo_list = PoTrackingNonms::get();
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
            'date_po' => 'required',
            'contract' => 'required',
            'date_contract' => 'required'
        ]);

        // $payment_amount = PoTrackingNonms::whereIn('po_tracking_nonms_master.id',$this->wo_id)
        //                     ->join('po_tracking_nonms_boq','po_tracking_nonms_boq.id_po_nonms_master','=','po_tracking_nonms_master.id')->sum('po_tracking_nonms_boq.total_price');
        
        $po = new PoTrackingNonmsPo();
        $po->po_number = $this->po_number;
        $po->date_po_sc = $this->date_po;
        $po->date_po_sys = date('Y-m-d');
        $po->contract = $this->contract;
        $po->date_contract = $this->date_contract;
        // $po->payment_amount = $payment_amount;
        // $po->po_tracking_nonms_id = 0;
        $po->works = $this->works;
        $po->save();

        $payment_amount = 0;
        foreach($this->wo_line_item as $k => $item){
            $boq = PoTrackingNonmsBoq::find($item);
            $boq->po_tracking_nonms_po_id = $po->id;
            $boq->po = $this->po_number;
            $boq->save();
            $payment_amount = $boq->input_price;
        }

        $po->payment_amount = $payment_amount;
        $po->save();

        foreach($this->wo_id as $k => $i){
            $total_boq = PoTrackingNonmsBoq::whereNull('po_tracking_nonms_po_id')->where('id_po_nonms_master',$i)->get()->count();
            if($total_boq==0) 
                PoTrackingNonms::where('id',$i)->update(['po_status'=>2]);
            else
                PoTrackingNonms::where('id',$i)->update(['po_status'=>1]);
        }

        session()->flash('message-success',"PO Number submitted");

        return redirect()->route('po-tracking-nonms.index');
    }

    public function add_wo()
    {
        $this->wos[] = null;$this->wo_id[]=null;
        $this->error_message = '';
        $this->emit('select-wo');
    }
}
