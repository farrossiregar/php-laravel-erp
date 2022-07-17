<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;

class WeeklyOpexEditablePic extends Component
{
    public $employee_id,$is_edit=false,$data,$value;
    protected $listeners = ['reload-pic'=>'$refresh'];
    public function render()
    {
        return view('livewire.finance.weekly-opex-editable-pic');
    }

    public function mount($data)
    {
        $this->data = $data;
    }

    public function updated($propertyName)
    {
        if($propertyName=='is_edit') $this->emit('is-edit');
    }

    public function save()
    {
        $this->data->employee_id = $this->employee_id;
        $this->data->save();

        $this->is_edit = false;
        $this->emit('reload-pic');
    }
}
