<?php

namespace App\Http\Livewire\Finance\HqAdministration;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\HqAdministrationType as ModelHqAdministrationType;

class HqAdministrationType extends Component
{
    protected $listeners = ['reload'=>'$refresh'];
    public $insert=false,$name;
    public function render()
    {
        $data = ModelHqAdministrationType::where('company_id',session()->get('company_id'))->orderBy('id','DESC');

        return view('livewire.finance.hq-administration.hq-administration-type')->with(['data'=>$data->get()]);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required',
                Rule::unique('hqadministration_type')->where(function ($query) {
                    return $query->where('company_id',session()->get('company_id'))->where('name', $this->name);
                })
            ],
        ],
        [
            'name.unique' => 'Data already exists'
        ]);

        $data = new ModelHqAdministrationType();
        $data->company_id = session()->get('company_id');
        $data->name = $this->name;
        $data->save();

        $this->insert = false;
        $this->reset(['name']);
        $this->emit('reload');
    }
}