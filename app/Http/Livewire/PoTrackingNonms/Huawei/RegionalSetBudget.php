<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuaweiItem;
use App\Models\PoTrackingNonmsHuawei;

class RegionalSetBudget extends Component
{
    public $data;
    public $pr_no,$date_of_req_pr,$supplier,$pr_amount,$margin,$status_pr;
    protected $listeners = ['regional_set_budget'=>'regional_set_budget'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.regional-set-budget');
    }

    public function regional_set_budget(PoTrackingNonmsHuaweiItem $data)
    {
        $this->pr_no = $data->pr_no;
        $this->date_of_req_pr = $data->date_of_req_pr;
        $this->supplier = $data->supplier;
        $this->pr_amount = $data->pr_amount;
        $this->margin = $data->margin;
        $this->status_pr = $data->status_pr;
        $this->data = $data;
    }

    public function updated()
    {
        if($this->pr_amount){
            $amount =$this->data->line_amount - $this->pr_amount;
            $this->margin = round(($amount/$this->data->line_amount) * 100,2);
        }else
            $this->margin = 0;
        
    }

    public function save()
    {
        $this->data->pr_no = $this->pr_no;
        $this->data->date_of_req_pr = $this->date_of_req_pr;
        $this->data->supplier = $this->supplier;
        $this->data->pr_amount = $this->pr_amount;
        $this->data->margin = $this->margin;
        $this->data->status_pr = $this->status_pr;
        $this->data->save();


        if($this->data->margin<30)
            $this->data->status = 3;  // PMG Review karna profit dibawah 30%
        else
            $this->data->status = 1; // Finance review
        
        $this->data->save();

        // $parent = PoTrackingNonmsHuawei::where('id',$this->data->po_tracking_nonms_huawei_id)
        //                                 ->withSum('items','po_amount')
        //                                 ->withSum('items','pr_amount')
        //                                 ->first();
        // if($parent){
        //     $margin = $parent->items_sum_po_amount - $parent->items_sum_pr_amount;
        //     $parent->po_amount =  $parent->items_sum_po_amount;
        //     $parent->pr_amount =  $parent->items_sum_pr_amount;
        //     $parent->margin =  @($margin/$parent->items_sum_po_amount)*100;
        //     $parent->save();
        // }

        $this->emit('modal','hide');
        $this->emit('reload-page');
    }
}
