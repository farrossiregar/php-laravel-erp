<?php

namespace App\Http\Livewire\Vehicle;

use Livewire\Component;
use App\Models\VehicleSyncron;
use App\Models\EPL\VehicleVendor;
use App\Models\VehicleCheck;
use App\Models\Vehicle;
use App\Models\ClientProjectRegion;
use App\Models\SubRegion;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $listeners = ['reload'=>'$refresh','syncron'=>'syncron'];
    protected $paginationTheme = 'bootstrap';
    public $total=0,$count=0,$find_vehicle,$is_sync=false, $selected_id,$note;
    public $is_access_valid=false,$is_access_audit=false,$keyword,$region_id,$regions,$sub_region_id,$sub_region=[];
    public function render()
    {
        $data = VehicleSyncron::with(['epl_vehicle.vendor','epl_vehicle.vehicle','project','region','driver_employee'])
                                ->orderBy('id','DESC');
        if($this->keyword) {
            $data->where(function($table){
                foreach(\Illuminate\Support\Facades\Schema::getColumnListing('vehicle_syncron') as $column){
                    $table->orWhere($column,'LIKE',"%{$this->keyword}%");
                }
            });
        }
        if($this->region_id) $data->where('region_id',$this->region_id);
        if($this->sub_region_id) $data->where('sub_region_id',$this->sub_region_id);
        
        $total = clone $data;
        $total_match = clone $data;

        return view('livewire.vehicle.data')->with(['data'=>$data->paginate(100),'total_data'=>$total->count(),'total_match'=>$total_match->whereNotNull('epl_vehicle_id')->count()]);
    }

    public function updated()
    {
        if($this->region_id) $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function mount()
    {
        \LogActivity::add('[web] Vehicle');

        $this->is_access_valid = check_access('vehicle.validate');
        $this->is_access_audit = check_access('vehicle.audit');
        $this->regions = ClientProjectRegion::select('region.*')
                                                ->where('client_project_id',session()->get('project_id'))
                                                ->join('region','region.id','client_project_region.region_id')
                                                ->groupBy('region.id')
                                                ->get();
    }

    public function set_id(VehicleSyncron $data)
    {
        $this->selected_id = $data;
    }
    
    public function submit_valid()
    {
        $this->selected_id->note_sm = $this->note;
        $this->selected_id->status = 1;
        $this->selected_id->save();

        $this->emit('reload');
        $this->emit('message-success','Vehicle updated valid.');
        \LogActivity::add('[web] Vehicle Submit Valid');
    }

    public function submit_audit($is_audit)
    {
        if($is_audit==0)
            $this->validate([
                'note'=>'required'
            ]);
            
        $this->selected_id->note_pmg = $this->note;
        $this->selected_id->status = 3;
        $this->selected_id->is_audit = $is_audit;
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
        
        VehicleSyncron::where(['is_syncron'=>1,'client_project_id'=>session()->get('project_id')])->update(['is_syncron'=>0]);

        $this->total = VehicleCheck::whereNotNull('plat_nomor')
                                    ->where(['client_project_id'=>session()->get('project_id')])
                                    ->groupBy('plat_nomor')->get()->count();
        $this->syncron();
        \LogActivity::add('[web] Vehicle Sync');
    }

    public function syncron()
    {
        if(!$this->is_sync) return false;
        
        $notIn = VehicleSyncron::where('is_syncron',1)
                                ->where('client_project_id',session()->get('project_id'))
                                ->pluck('no_polis')->toArray();
        $vehicle_check = VehicleCheck::whereNotNull('plat_nomor')
                                        ->where('client_project_id',session()->get('project_id'))
                                        ->whereNotIn('plat_nomor',$notIn)
                                        ->orderBy('id','DESC')
                                        ->first();
        $no_polisi =  ltrim($vehicle_check->plat_nomor);
        $no_polisi =  rtrim($no_polisi);
        
        $vehicle_vendor = VehicleVendor::where('no_polisi',$no_polisi)->first();

        $vehicle_syncron = VehicleSyncron::where('no_polis',$no_polisi)->first();
        if(!$vehicle_syncron){
            $vehicle_syncron = new VehicleSyncron();
            $vehicle_syncron->client_project_id = session()->get('project_id');
        } 
        
        $vehicle_syncron->erp_vehicle_check_id = $vehicle_check->id;
        $vehicle_syncron->no_polis = $no_polisi;
        if($vehicle_vendor){
            $vehicle_syncron->epl_vehicle_id = $vehicle_vendor->id;
            $vehicle_syncron->vendor = isset($vehicle_vendor->vendor->name)?$vehicle_vendor->vendor->name:'';
            $vehicle_syncron->brand = isset($vehicle_vendor->vehicle->brand)?$vehicle_vendor->vehicle->brand:'';
            $vehicle_syncron->type = isset($vehicle_vendor->vehicle->type)?$vehicle_vendor->vehicle->type:'';
            $vehicle_syncron->merk = isset($vehicle_vendor->vehicle->merk)?$vehicle_vendor->vehicle->merk:'';
            $vehicle_syncron->tahun = isset($vehicle_vendor->vehicle->tahun)?$vehicle_vendor->vehicle->tahun:'';
        }
        $vehicle_syncron->employee_id = \Auth::user()->employee->id;
        $vehicle_syncron->car_motorcycle = 1;
        $vehicle_syncron->is_syncron = 1;
        $vehicle_syncron->region_id = $vehicle_check->region_id;
        $vehicle_syncron->sub_region_id = $vehicle_check->sub_region_id;
        $vehicle_syncron->driver_employee_id = $vehicle_check->employee_id;       
        $vehicle_syncron->save();

        // check vehicle
        $vehicle = Vehicle::where('no_polisi',$no_polisi)->first();
        if(!$vehicle) $vehicle = new Vehicle();
        $vehicle->no_polisi = $no_polisi;
        $vehicle->employee_id = $vehicle_check->employee_id;
        $vehicle->client_project_id = session()->get('project_id');
        $vehicle->region_id = $vehicle_check->region_id;
        $vehicle->sub_region_id = $vehicle_check->sub_region_id;
        $vehicle->save();

        $this->count = VehicleSyncron::where(['is_syncron'=>1,'client_project_id'=>session()->get('project_id')])->get()->count();
        
        if($this->count==$this->total) $this->is_sync=false;
        $this->emit('syncron');
    }
}