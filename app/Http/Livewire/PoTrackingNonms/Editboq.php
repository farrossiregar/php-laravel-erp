<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsBoq;
use App\Models\PoTrackingNonms;
use DB;

class Editboq extends Component
{
    public $data, $total_before, $total_after, $total_profit, $id_master, $status,$bast_status;
    public function render()
    {
        return view('livewire.po-tracking-nonms.edit-boq');
    }


    public function mount(PoTrackingNonms $id)
    {
        $this->data             = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)->get();  
        
        $this->total_before     = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)
                                                    ->select(DB::raw("SUM(price) as price"))    
                                                    ->groupBy('id_po_nonms_master')  
                                                    ->get();  

        $this->total_after      = PoTrackingNonmsBoq::where('id_po_nonms_master', $id->id)
                                                    ->select(DB::raw("SUM(input_price) as input_price"))    
                                                    ->groupBy('id_po_nonms_master')  
                                                    ->get();  
        
        $this->id = $id->id;
        $this->id_master = $id->id;

        $total_before = json_decode($this->total_before);
        $total_before = $total_before[0]->price;
        $total_after = json_decode($this->total_after);
        $total_after = $total_after[0]->input_price;
        if($total_before && $total_after){
            $this->total_profit = 100 - round(($total_after / $total_before) * 100);
        }else{
            $this->total_profit = '100';
        }

        $this->status = $id->status; 
        $this->bast_status = $id->bast_status;
    }
}