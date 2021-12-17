<?php

namespace App\Http\Livewire\Vehicle;

use Livewire\Component;
use App\Models\VehicleSyncron;
use App\Models\EPL\VehicleVendor;
use App\Models\VehicleCheck;
use App\Models\Vehicle;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $listeners = ['reload'=>'syncron'];
    protected $paginationTheme = 'bootstrap';
    public $total=0,$count=0,$find_vehicle,$is_sync=false;
    public function render()
    {
        $data = VehicleSyncron::with(['epl_vehicle.vendor','epl_vehicle.vehicle'])->orderBy('id','DESC')->paginate(100);

        return view('livewire.vehicle.data')->with(['data'=>$data]);
    }
    public function syncron()
    {
        // if(!$this->is_sync) return false;
        $notIn = VehicleSyncron::pluck('epl_vehicle_id')->toArray();
        $this->total = VehicleVendor::count();
        
        $find_vehicle = VehicleVendor::whereNotIn('id',$notIn)->first();
        
        if($find_vehicle){
            $this->count = VehicleSyncron::count();
            $vehicle = Vehicle::where('no_polisi',$find_vehicle->no_polisi)->first();
            if(!$vehicle){
                $vehicle = new Vehicle();
                $vehicle->no_polisi = $find_vehicle->no_polisi;
                $vehicle->save();
            }

            $find = VehicleCheck::where('plat_nomor',$find_vehicle->no_polisi)->first();
            $data = new VehicleSyncron();
            $data->employee_id = \Auth::user()->employee->id;
            $data->epl_vehicle_id = $find_vehicle->id;
            if($find){
                $vehicle->vehicle_check_id = $find->id;
                $vehicle->save();
                $data->erp_vehicle_id = $vehicle->id;                
            }
            $data->save();

            $this->count = VehicleSyncron::count();
            $this->emit('reload');
        }
    }
}