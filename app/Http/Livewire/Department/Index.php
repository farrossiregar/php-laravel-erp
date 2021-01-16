<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = \App\Models\Department::orderBy('name','ASC');

        return view('livewire.department.index')->with(['data'=>$data->paginate(100)]);
    }
}
