<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cluster;

class Index extends Component
{
    public $keyword;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = Cluster::orderBy('id','DESC');

        

        return view('livewire.cluster.index')->with(['data'=>$data->paginate(100)]);
    }
}
