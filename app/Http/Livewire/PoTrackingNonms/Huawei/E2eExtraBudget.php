<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuawei;

class E2eExtraBudget extends Component
{
    protected $listeners = ['set_id'=>'set_id'];
    public $data,$amount;
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.e2e-extra-budget');
    }

    public function set_id(PoTrackingNonmsHuawei $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->validate([
            'amount' => 'required'
        ]);

        $this->data->extra_budget = $this->amount;
        $this->data->status_extra_budget=1;
        $this->data->save();

        $this->emit('modal','hide');
        $this->emit('message-success','Extra budget requested');
        $this->emit('reload-page');
    }
}
