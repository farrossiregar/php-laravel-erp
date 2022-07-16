<?php

namespace App\Http\Livewire\Finance\OtherOpex;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\OtherOpexType as ModelOtherOpexType;

class OtherOpexType extends Component
{
    protected $listeners = ['reload'=>'$refresh'];
    public $insert=false,$name;
    public function render()
    {
        $data = ModelOtherOpexType::where('company_id',session()->get('company_id'))->orderBy('id','DESC');

        return view('livewire.finance.other-opex.other-opex-type')->with(['data'=>$data->get()]);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required',
                Rule::unique('other_opex_type')->where(function ($query) {
                    return $query->where('company_id',session()->get('company_id'))->where('name', $this->name);
                })
            ],
        ],
        [
            'name.unique' => 'Data already exists'
        ]);

        $data = new ModelOtherOpexType();
        $data->company_id = session()->get('company_id');
        $data->name = $this->name;
        $data->save();

        $this->insert = false;
        $this->reset(['name']);
        $this->emit('reload');
    }
}