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
    protected $listeners = ['reload'=>'$refresh','syncron'=>'syncron'];
    protected $paginationTheme = 'bootstrap';
    public $total=0,$count=0,$find_vehicle,$is_sync=false, $selected_id,$note;
    public $is_access_valid=false,$is_access_audit=false,$keyword;
    public function render()
    {
        $data = VehicleSyncron::with(['epl_vehicle.vendor','epl_vehicle.vehicle','project','region','driver_employee'])->orderBy('id','DESC');

        if($this->keyword) {
            $data->where(function($table){
                foreach(\Illuminate\Support\Facades\Schema::getColumnListing('vehicle_syncron') as $column){
                    $table->orWhere($column,'LIKE',"%{$this->keyword}%");
                }
            });
        }
        
        return view('livewire.vehicle.data')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        \LogActivity::add('[web] Vehicle');

        $this->is_access_valid = check_access('vehicle.validate');
        $this->is_access_audit = check_access('vehicle.audit');
    }

    public function set_id(VehicleSyncron $data)
    {
        $this->selected_id = $data;
    }
    
    public function submit_valid(VehicleSyncron $data)
    {
        $data->status = 1;
        $data->save();

        $this->emit('reload');
        $this->emit('message-success','Vehicle updated valid.');
        \LogActivity::add('[web] Vehicle Submit Valid');
    }

    public function submit_audit(VehicleSyncron $data)
    {
        $this->selected_id->note_pmg = $this->note;
        $this->selected_id->status = 3;
        $this->selected_id->save();

        $this->emit('reload');
        $this->emit('message-success','Vehicle Audited.');
        \LogActivity::add('[web] Vehicle Submit Audit');
    }

    public function submit_invalid()
    {
        $this->validate([
            'note'=>'required'
        ]);

        $this->selected_id->note_psm = $this->note;
        $this->selected_id->status = 2;
        $this->selected_id->save();

        $this->emit('reload');
        $this->emit('message-success','Vehicle updated invalid.');
        \LogActivity::add('[web] Vehicle Submit Invalid');
    }

    public function start_sync()
    {
        $this->is_sync = true;
        VehicleSyncron::where('is_syncron',1)->update(['is_syncron'=>0]);
        $this->total = VehicleVendor::count();
        $this->syncron();
        \LogActivity::add('[web] Vehicle Sync');
    }

    public function syncron()
    {
        if(!$this->is_sync) return false;
        
        $notIn = VehicleSyncron::where('is_syncron',1)->pluck('epl_vehicle_id')->toArray();
        
        $find_vehicle = VehicleVendor::whereNotIn('id',$notIn)->first();
        
        if($find_vehicle){
            $no_polisi =  ltrim($find_vehicle->no_polisi);
            $no_polisi =  rtrim($no_polisi);

            $vehicle = Vehicle::where('no_polisi',$no_polisi)->first();
            if(!$vehicle){
                $vehicle = new Vehicle();
                $vehicle->no_polisi = $find_vehicle->no_polisi;
                $vehicle->save();
            }

            $find = VehicleCheck::where('plat_nomor',"LIKE", $no_polisi)->first();
            $data = VehicleSyncron::where('no_polis',$no_polisi)->first();
            
            if(!$data) $data = new VehicleSyncron();
            $data->is_syncron = 1;
            $data->no_polis = $no_polisi;
            $data->vendor = isset($vehicle->epl_vehicle->vendor->name)?$vehicle->epl_vehicle->vendor->name:'';
            $data->brand = isset($vehicle->epl_vehicle->vehicle->brand)?$vehicle->epl_vehicle->vehicle->brand:'';
            $data->type = isset($vehicle->epl_vehicle->vehicle->type)?$vehicle->epl_vehicle->vehicle->type:'';
            $data->merk = isset($vehicle->epl_vehicle->vehicle->merk)?$vehicle->epl_vehicle->vehicle->merk:'';
            $data->tahun = isset($vehicle->epl_vehicle->vehicle->tahun)?$vehicle->epl_vehicle->vehicle->tahun:'';
            $data->employee_id = \Auth::user()->employee->id;
            $data->car_motorcycle = 1;
            $data->epl_vehicle_id = $find_vehicle->id;
            if($find){
                $vehicle->vehicle_check_id = $find->id;
                $vehicle->save();
                $data->erp_vehicle_id = $vehicle->id;
                $data->erp_vehicle_check_id = $find->id;
                $data->project_id = $find->client_project_id;
                $data->region_id = $find->region_id;                
                $data->cluster_id = $find->sub_region_id;   
                $data->driver_employee_id = $find->employee_id;       
                $data->stnk_no	 = $find_vehicle->stnk_no;
                $data->end_date_pajak	 = $find_vehicle->stnk_end_date;
            }
            $data->save(); 
        }

        $this->count = VehicleSyncron::where('is_syncron',1)->get()->count();
        if($this->count==$this->total) $this->is_sync=false;
        $this->emit('syncron');
    }
}