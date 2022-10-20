<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;
use App\Models\PoTrackingNonmsBoq;

class IndexPo extends Component
{
    public $keyword,$is_service_manager,$is_e2e,$is_finance,$filter_status_po;
    public function render()
    {
        $data = PoTrackingNonmsPo::orderBy('id','DESC');

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_tracking_nonms_po') as $column){
                $table->orWhere('po_tracking_nonms_po.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });
        
        if($this->filter_status_po) {
            if($this->filter_status_po==0){
                $data->where(function($table){
                    $table->where('status','0')->orWhere('status','');
                });
            }else $data->where('status',$this->filter_status_po);
        }

        return view('livewire.po-tracking-nonms.index-po')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_e2e = check_access('is-e2e');
        $this->is_finance = check_access('is-finance');
    }

    public function calculate_amount(PoTrackingNonmsPo $id)
    {
        $payment_amount = 0;
        foreach(PoTrackingNonmsBoq::where('po_tracking_nonms_po_id',$id->id)->get() as $k => $item){
            $payment_amount = $item->input_price;
        }

        $id->payment_amount = $payment_amount;
        $id->save();
    }
}
