<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\AccountPayableWeeklyopex;
use App\Models\WeeklyOpexBudget;
use Livewire\WithFileUploads;
use DateTime;

class WeeklyOpexSettle extends Component
{
    use WithFileUploads;
    protected $listeners = ['set_id'];
    public $file,$data,$total=0,$total_settle=0,$total_difference=0,$item_description,$item_amount=[];
    public function render()
    {
        
        return view('livewire.finance.weekly-opex-settle');
    }

    public function set_id(AccountPayableWeeklyopex $data)
    {
        $this->item_description = [];$this->item_amount=[];
        $this->data = $data;$this->total=0;$this->total_settle=0;$this->total_difference=0;
        if(isset($this->data->items)){
            foreach($this->data->items as $k =>$item){
                $this->item_amount[$k] = $item->amount;
                $this->item_description[$k] = $item->description;
                $this->total += $item->amount;
                $this->total_settle += $item->amount;
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

        // if($this->total_difference){
        //     $this->data->budget_opex = $this->data->budget_opex + $this->total_difference;
            // $this->data->remain = $this->data->budget_opex - $this->total_difference;

            // $budget = WeeklyOpexBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>$this->data->employee->department_id])->first();
            // $budget = WeeklyOpexBudget::where(['company_id'=>session()->get('company_id'),'project'=>\Auth::user()->employee->project,'week'=>$this->weekOfMonth(date('Y-m-d')), 'region'=>\Auth::user()->employee->region_id])->first();
            // if($budget){
            //     $budget->budget = $budget->amount + $this->total_difference;
                // $budget->remain = $budget->amount - $this->total_difference;
            // }   
        // }

        // $this->data->difference = $this->total_difference;
        $this->data->total_settlement = $this->total_settle;
        $this->data->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('weekly-opex.index');
    }

    public function weekOfMonth($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
}
