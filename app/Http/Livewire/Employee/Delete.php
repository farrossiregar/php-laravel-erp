<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class Delete extends Component
{
    public $employee_id;
    protected $listeners = ['emit-delete' => 'emitDelete'];
    public function render()
    {
        return view('livewire.employee.delete');
    }
    public function emitDelete($id)
    {
        $this->employee_id = $id;
    }
    public function delete()
    {
        \App\Models\Employee::find($this->employee_id)->delete();
        $this->emit('emit-delete-hide');
        $this->reset();
    }
}
