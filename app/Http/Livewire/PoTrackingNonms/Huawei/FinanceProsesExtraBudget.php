<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuaweiItem;

class FinanceProsesExtraBudget extends Component
{
    public $data;
    protected $listeners = ['set_id'=>'set_id'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.finance-proses-extra-budget');
    }

    public function set_id(PoTrackingNonmsHuaweiItem $id)
    {
        $this->data = $id;
    }

    public function approve()
    {
        $this->data->status_extra_budget=2;
        $this->data->save();

        $this->emit('modal','hide');
        $this->emit('message-success','Extra budget Acknowledge');
        $this->emit('reload-page');

        \LogActivity::add('[web] PO Non MS Huawei - Extra Budget Acknowledge');

        session()->flash('message-success',"Extra budget Acknowledge");
    }
}