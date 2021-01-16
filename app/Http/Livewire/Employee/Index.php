<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = \App\Models\Employee::orderBy('id','DESC');

        return view('livewire.employee.index')->with(['data'=>$data->paginate(100)]);
    }
}
