<?php

namespace App\Http\Livewire\Finance\OtherOpex;

use Livewire\Component;
use App\Models\AccountPayableOtheropex;
use App\Models\WeeklyOpexBudgetDate;
use App\Models\OtherOpexBudget;
use App\Models\WeeklyOpexBudget;

class OtherOpexProcess extends Component
{
    public $note,$selected;
    protected $listeners = ['check_id'];
    public function render()
    {
        return view('livewire.finance.other-opex.other-opex-process');
    }

    public function check_id(AccountPayableOtheropex $selected)
    {
        $this->selected = $selected;
    }

    public function approve()
    {
        $this->selected->status = 1; // approve
        $this->save();

        $find = WeeklyOpexBudgetDate::where(['year'=>date('Y')])->where(
                                        function ($query){
                                         $query->whereRaw('? between start_date and end_date', [$this->selected->period]);
                                        })
                                        ->first();
        if($find){
            // find budget
            $budget = WeeklyOpexBudget::where(['month'=>$find->month,
                                            'year'=>$find->year,
                                            'client_project_id'=>$this->selected->client_project_id,
                                            'employee_id'=>$this->selected->employee_id])->first();
            if($budget){
                $week = 'week_'.$find->week;
                $budget->$week = $budget->$week + $this->selected->total_transfer;
                $budget->save(); 
            }
        }
    }

    public function reject()
    {
        $this->selected->status = 3; // reject
        $this->save();
    }

    public function save()
    {
        $this->selected->app_staff_note = $this->note;
        $this->selected->save();
        
        // save status master data
        $this->selected->status=1;
        $this->selected->master->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('other-opex.index');
    }
}
