<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\WeeklyOpexBudget as ModelWeeklyOpexBudget;

class WeeklyOpexBudget extends Component
{
    public $project_id,$week,$insert=false,$budget;
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
        $data->amount = $this->budget;
        $data->save();

        $this->insert = false;
        $this->reset(['budget']);
        $this->emit('reload');
    }
}
