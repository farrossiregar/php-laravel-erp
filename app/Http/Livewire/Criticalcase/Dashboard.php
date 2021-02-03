<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;

use App\Helpers\GeneralHelper;
use DB;

class Dashboard extends Component
{
    public $year,$region_id;
    public $month = [];
    public function render()
    {
     
        return view('livewire.criticalcase.dashboard');
    }
}
