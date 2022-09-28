<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuaweiItem;
use Livewire\WithFileUploads;

class FinanceTransferBudget extends Component
{
    use WithFileUploads;
    public $amount,$data,$file;
    protected $listeners = ['set_id'=>'set_id'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.finance-transfer-budget');
    }

    public function set_id(PoTrackingNonmsHuaweiItem $id)
    {
        $this->data = $id;
        $this->amount = $id->pr_amount;       
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

        return redirect()->route('po-tracking-nonms.huawei');
    }
}