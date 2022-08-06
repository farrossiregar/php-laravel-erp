<?php

namespace App\Http\Livewire\Finance\Sitekeeper;

use Livewire\Component;
use App\Models\AccountPayableSitekeeper;
use Livewire\WithFileUploads;

class SitekeeperSettleDetail extends Component
{
    use WithFileUploads;
    protected $listeners = ['set_id'];
    public $file,$data,$total=0,$total_settle=0,$total_difference=0,$item_description,$item_amount=[];
    public function render()
    {
        return view('livewire.finance.sitekeeper.sitekeeper-settle-detail');
    }

    public function set_id(AccountPayableSitekeeper $data)
    {
        $this->item_description = [];$this->item_amount=[];
        $this->data = $data;$this->total=0;$this->total_settle=0;$this->total_difference=0;
        if(isset($this->data->items)){
            foreach($this->data->items as $k =>$item){
                $this->item_amount[$k] = $item->amount;
                $this->item_description[$k] = $item->description;
                $this->total += $item->amount;
                $this->total_settle += $item->amount_settle;
            }
        }
    }

    public function updated($propertyName)
    {
        $this->total_settle = 0;
        foreach($this->item_amount as $val) $this->total_settle += $val;
        $this->total_difference = $this->total - $this->total_settle;
    }
    
    public function save()
    {
        $this->data->status =2;
        $this->data->settlement_date = date('Y-m-d');

        if($this->file){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);
            $name = 'settle_doc'.date('Ymd').'.'.$this->file->extension();
            $this->file->storeAs("public/account-payable/{$this->data->id}", $name);
            $this->data->doc_settlement = "storage/account-payable/{$this->data->id}/".$name;
        }

        foreach($this->data->items as  $k => $item){
            $item->amount_settle = $this->item_amount[$k];
            $item->save();
        }

        $this->data->difference = $this->total_difference;
        $this->data->total_settlement = $this->total_settle;
        $this->data->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('sitekeeper.index');
    }
}
