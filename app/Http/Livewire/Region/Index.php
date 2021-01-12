<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public function render()
    {
        $data = \App\Models\Region::orderBy('id','DESC');

        return view('livewire.region.index')
                    ->with(['data'=>$data->paginate(100)]);
    }
}
