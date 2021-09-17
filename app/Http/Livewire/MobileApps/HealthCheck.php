<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\HealthCheck as HealthCheckModel;
use Livewire\WithPagination;

class HealthCheck extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $date_start,$date_end;

    public function render()
    {
        $data = HealthCheckModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.health-check')->with(['data'=>$data->paginate(100)]);
    }
}
