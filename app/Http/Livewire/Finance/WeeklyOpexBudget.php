<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\WeeklyOpexBudget as ModelWeeklyOpexBudget;

class WeeklyOpexBudget extends Component
{
    public $project_id,$week,$insert=false,$budget,$region, $subregion;
    public function render()
    {
        $data = ModelWeeklyOpexBudget::get();

        return view('livewire.finance.weekly-opex-budget')->with(['data'=>$data]);
    }

    public function save()
    {
        $this->validate([
            'project_id'=>'required',
            'week'=>'required',
            'budget'=>'required',
        ]);

        $data = new ModelWeeklyOpexBudget();
        $data->company_id = session()->get('company_id');
        $data->project = $this->project_id;
        $data->amount = $this->budget;
        $data->region = $this->region;
        $data->subregion = $this->subregion;
        $data->week = $this->week;
        $data->save();

        $this->insert = false;
        $this->reset(['budget']);
        $this->emit('reload');
    }

    public function weekOfMonth($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
}
