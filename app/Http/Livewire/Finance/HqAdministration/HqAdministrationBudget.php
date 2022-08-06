<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\HqAdministrationBudget as ModelHqAdministrationBudget;
use Illuminate\Validation\Rule;

class HqAdministrationBudget extends Component
{
    protected $listeners = ['reload'=>'$refresh'];
    public $filter_year,$insert=false,$year,$department_id,$budget,$message,$validate_unique,$sub_department_id;
    public function render()
    {
        $data = ModelHqAdministrationBudget::where('company_id',session()->get('company_id'))->orderBy('id','DESC');

        if($this->filter_year) $data->where('year',$this->filter_year);

        return view('livewire.finance.hqadministration.hqadministration-budget')->with(['data'=>$data->get()]);
    }

    public function save()
    {
        
        $this->validate([
            // 'year' => ['required',
            //     Rule::unique('petty_cash_budget')->where(function ($query) {
            //         return $query->where('company_id',session()->get('company_id'))->where('year', $this->year)->where('department_id', $this->department_id);
            //     })
            // ],
            'department_id'=>'required',
            'budget'=>'required',
            'sub_department_id' => 'required'
        ]
        // ,
        // [
        //     'year.unique' => 'Data already exists'
        // ]
    );

        

        $data = new ModelHqAdministrationBudget();
        $data->company_id = session()->get('company_id');
        $data->year = $this->year;
        $data->department_id = $this->department_id;
        $data->sub_department_id = $this->sub_department_id;
        $data->amount = $this->budget;
        $data->save();

        

        $this->insert = false;
        $this->reset(['year','department_id','budget']);
        $this->emit('reload');
    }
}