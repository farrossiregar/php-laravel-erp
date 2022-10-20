<?php

namespace App\Http\Livewire\PoTrackingMs\Huawei;

use Livewire\Component;
use App\Models\PoMsHuawei;

class Editable extends Component
{
    public $insert = false,$value,$field,$data;
    public function render()
    {
        return view('livewire.po-tracking-ms.huawei.editable');
    }

    public function mount($data,$field,$value)
    {
        $this->data = $data;
        $this->field = $field;
        $this->value = $value;
    }

    public function save()
    {
        $value = [$this->field=>$this->value];

        // jika qty maka kalkulasi ulang total_amount
        if($this->field=='qty') {
            $value['total_amount'] = $this->data->unit_price * $this->value;
            $value['rp_deduction'] = (($value['total_amount']*$this->data->deduction) / 100) + $this->data->ehs_other_deduction;
        }

        if($this->field=='deduction') $value['rp_deduction'] = (($this->data->total_amount*$this->value) / 100) + $this->data->ehs_other_deduction;
        if($this->field=='ehs_other_deduction') $value['rp_deduction'] = (($this->data->total_amount*$this->data->deduction) / 100) + $this->value;

        PoMsHuawei::where('id',$this->data->id)->update($value);

        $this->insert = false;
        $this->emit('message-success','Saved.');
        $this->emit('reload-page');
    }
}
