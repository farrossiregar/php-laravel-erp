<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsBoq;
use App\Models\PoTrackingNonms;
use DB;

class Editboq extends Component
{
    public $po_tracking,$note;
    public $data, $total_price_ericson, $total_after, $total_profit, $id_master, $status,$bast_status,$is_finance,$is_service_manager;
    public $total_ericson  = 0;
    public function render()
    {
        return view('livewire.po-tracking-nonms.edit-boq');
    }

    public function mount(PoTrackingNonms $id)
    {
        $this->po_tracking = $id;
        $this->data             = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)->get();  
        $this->total_before     = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)
                                                    ->select(DB::raw("SUM(price) as price"),DB::raw("SUM(qty) as total_qty"))    
                                                    ->groupBy('id_po_nonms_master')  
                                                    ->get();  

        $this->total_after      = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)
                                                    ->select(DB::raw("SUM(input_price) as input_price"))    
                                                    ->groupBy('id_po_nonms_master')  
                                                    ->get();  

        foreach($this->data as $item) $this->total_ericson += $item->price * $item->qty;
        
        $this->id = $id->id;
        $this->id_master = $id->id;

        $total_before = json_decode($this->total_before);
        $total_before = @$total_before[0]->price;
        $total_after = json_decode($this->total_after);
        $total_after = @$total_after[0]->input_price;
        if($this->total_ericson && $total_after)
            $this->total_profit = 100 - round(($total_after / $this->total_ericson) * 100);
        else
            $this->total_profit = '100';

        $this->status = $id->status;
        $this->bast_status = $id->bast_status;
        $this->is_finance = check_access('is-finance');
        $this->is_service_manager = check_access('is-service-manager');
    }


    public function finance_reject_budet()
    {
        $this->validate([
            'note'=>'required'
        ]);

        $this->po_tracking->note_finance = $this->note;
        $this->po_tracking->status = 0;
        $this->po_tracking->is_revise_finance = 1;
        $this->po_tracking->save();

        session()->flash('message-success',"Budget request rejected");
        
        return redirect()->route('po-tracking-nonms.edit-boq',['id'=>$this->po_tracking->id]);
    }

    public function finance_approve_budget()
    {
        $this->validate([
            'note'=>'required'
        ]);
        $this->po_tracking->note_finance = $this->note;
        $this->po_tracking->status = 2;
        $this->po_tracking->save();

        session()->flash('message-success',"Budget request approved");
        
        return redirect()->route('po-tracking-nonms.edit-boq',['id'=>$this->po_tracking->id]);
    }
}