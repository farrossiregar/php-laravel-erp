<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuawei;
use Livewire\WithFileUploads;

class FinanceTransferBudget extends Component
{
    use WithFileUploads;
    public $amount,$data,$file;
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.finance-transfer-budget');
    }

    public function mount(PoTrackingNonmsHuawei $data)
    {
        $this->data = $data;
        $this->amount = $data->pr_amount;       
    }
    
    public function save()
    {
        $this->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $name = date('ymdhis').".".$this->file->extension();
        $this->file->storeAs("public/po-tracking-nonms-huawei/{$this->data->id}", $name);
        $this->data->file_transfer = "storage/po-tracking-nonms-huawei/{$this->data->id}/{$name}";
        $this->data->status = 5;
        $this->data->save();

        session()->flash('message-success',"Success!, Budget for PO Tracking Non MS has been Succeed Transfered");

        return redirect()->route('po-tracking-nonms.huawei.detail',$this->data->id);
    }
}