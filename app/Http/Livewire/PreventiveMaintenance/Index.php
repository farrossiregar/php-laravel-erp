<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;
use App\Models\PreventiveMaintenance as PreventiveMaintenanceModel;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\Employee;

class Index extends Component
{
    public $keyword,$site_id,$description,$due_date,$project_id,$site_report,$site_owner,$regions=[],$sub_regions=[],$employees;
    public $site_category,$site_type,$site_name,$region_id,$pm_type,$cluster,$sub_cluster,$sub_region_id,$employee_id;
    protected $listeners = ['refresh-page'=>'$refresh'];
    
    public function render()
    {
        $data = $this->init_data();

        return view('livewire.preventive-maintenance.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->regions = Region::select('id','region')->get();
        $this->employees = Employee::select(['id','nik','name'])->where('user_access_id',85)->get(); // TE Engineer
    }

    public function updated($propertyName)
    {
        if($propertyName == 'region_id') $this->sub_regions = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function init_data()
    {
        $data = PreventiveMaintenanceModel::with(['employee'])->orderBy('id','DESC');
        if($this->keyword) 
            $data->where(function($table){
                foreach(\Illuminate\Support\Facades\Schema::getColumnListing('preventive_maintenance') as $column){
                    $table->orWhere($column,'LIKE',"%{$this->keyword}%");
                }});

        return $data;
    }

    public function set_report(PreventiveMaintenanceModel $id,$site_owner)
    {
        $this->site_report = $id;
        $this->site_owner = $site_owner;
    }

    public function store()
    {
        $this->validate([
            'site_id' => 'required',
            'description' => 'required'
        ]);

        $data = new PreventiveMaintenanceModel();
        $data->site_id = $this->site_id;
        $data->site_name = $this->site_name;
        $data->description  = $this->description;
        $data->site_category  = $this->site_category;
        $data->site_type  = $this->site_type;
        $data->pm_type  = $this->pm_type;
        $data->region_id  = $this->region_id;
        $data->sub_region_id  = $this->sub_region_id;
        $data->cluster  = $this->cluster;
        $data->sub_cluster  = $this->sub_cluster;
        $data->employee_id  = $this->employee_id;
        $data->admin_project_id = \Auth::user()->employee->id;
        $data->status = 0;
        $data->save();

        $this->reset(['site_id','description','due_date','project_id']);
        $this->emit('message-success','Preventive Maintenance Added');
        $this->emit('refresh-page');
    }
}
