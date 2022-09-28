<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuaweiItem;

class E2eBast extends Component
{
    public $data,$is_e2e=false,$gr_number,$gr_date;
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.e2e-bast');
    }

    public function mount(PoTrackingNonmsHuaweiItem $id)
    {
        $this->data = $id;
        $this->gr_number = $id->gr_number;
        $this->gr_date = $id->gr_date;
        $this->is_e2e = check_access('is-e2e');
    }

    public function approve()
    {
        $this->data->status = 12;
        $this->save(12);
    }

    public function revisi()
    {
        $this->data->status = 11;
        $this->save();
    }

    public function save()
    {
        $this->validate([
            'gr_number' => 'required',
            'gr_date' =>' required'
        ]);

        $this->data->gr_number = $this->gr_number;
        $this->data->gr_date = $this->gr_date;
        $this->data->save();

        session()->flash('message-success',"Success!, BAST Submitted");

        return redirect()->route('po-tracking-nonms.huawei.e2e-bast',$this->data->id);
    }
}
