<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class Index extends Component
{
    public $keyword;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = Company::orderBy('id','DESC');

        

        return view('livewire.company.index')->with(['data'=>$data->paginate(100)]);
    }
}
