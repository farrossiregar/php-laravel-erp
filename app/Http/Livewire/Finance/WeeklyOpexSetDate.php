<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\WeeklyOpexBudgetDate;

class WeeklyOpexSetDate extends Component
{
    protected $listeners=['week_active'=>'week_active'];
    public $start_date,$end_date,$week,$month;
    public function render()
    {
        return view('livewire.finance.weekly-opex-set-date');
    }

    public function week_active($data)
    {
        $this->week_id = $data['week'];
        $this->month = $data['month'];
    }

    public function save_set_date()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        // find
        $find  = WeeklyOpexBudgetDate::where(['month'=>$this->month,'year'=>date('Y'),'week'=>$this->week_id])->first();
        if(!$find){
            WeeklyOpexBudgetDate::create(
                [
                    'week' => $this->week_id,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'month' => $this->month,
                    'year' => date('Y')
                ]);
        }else{
            $find->start_date = $this->start_date;
            $find->end_date = $this->end_date;
            $find->save();
        }

        $this->emit('reload');
        $this->emit('close-modal-date');
    }
}
