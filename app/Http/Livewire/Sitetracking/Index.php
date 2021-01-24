<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cluster;
use App\Helpers\GeneralHelper;

class Index extends Component
{
    // public $keyword,$region_id;
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // protected $listeners = ['emit-delete-hide' => '$refresh'];
    public function render()
    {
        

        return view('livewire.sitetracking.index');
    }
}
