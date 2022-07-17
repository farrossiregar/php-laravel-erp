<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\WeeklyOpexBudget as ModelWeeklyOpexBudget;
use App\Models\ClientProject;

class WeeklyOpexBudget extends Component
{
    public $project_id,$week,$insert=false,$budget,$region,$subregion,$filter_month;
    public function render()
    {
        $data = ModelWeeklyOpexBudget::with(['client_project','regions'])->where(['company_id'=>session()->get('company_id'),'year'=>date('Y')]);

        if($this->filter_month){
            $data->where('month',$this->filter_month);
            $this->generate_budget($this->filter_month);
        }else
            $data->where('month',date('m'));

        return view('livewire.finance.weekly-opex-budget')->with(['data'=>$data->get()]);
    }

    public function generate_budget($month)
    {
        $count = ModelWeeklyOpexBudget::with(['client_project'])->where(['company_id'=>session()->get('company_id'),'month'=>$month,'year'=>date('Y')])->get()->count();

        if($count <=0){
            $budget =  ClientProject::select('client_projects.id','client_projects.name','client_project_region.region_id')
            ->join('client_project_region','client_project_region.client_project_id','=','client_projects.id')
            ->where('client_projects.is_project',1)
            ->groupBy('client_projects.id','client_project_region.region_id')->get();

            foreach($budget as $item){
                ModelWeeklyOpexBudget::insert([
                    'client_project_id' => $item->id,
                    'month' => $month,
                    'year' => date('Y'),
                    'region' => $item->region_id,
                    'company_id' => session()->get('company_id')
                ]);
            }
        }
    }


    public function mount()
    {
        $this->generate_budget(date('m'));
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
