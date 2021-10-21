<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\SpeedWarningAlarm as ModelSpeedWarningAlarm;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;
use App\Models\Region;
use App\Models\SubRegion;

class SpeedWarningAlarm extends Component
{
    public $speed_limit,$employee_id,$date_start,$date_end,$region=[],$sub_region=[],$region_id,$sub_region_id;
    public function render()
    {
        $data = ModelSpeedWarningAlarm::orderBy('id');

        if($this->employee_id) $data->where('employee_id',$this->employee_id);
        if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);
        if($this->region_id) {
            $data->where('speed_warning_alarms.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('speed_warning_alarms.sub_region_id',$this->sub_region_id);
        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('speed_warning_alarms.client_project_id',$client_project_ids);

        return view('livewire.mobile-apps.speed-warning-alarm')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->speed_limit = get_setting('speed_limit');
        $this->region  = Region::select(['id','region'])->get();
    }

    public function set_speed_warning()
    {
        $this->validate([
            'speed_limit' => 'required'
        ]);

        update_setting('speed_limit',$this->speed_limit);

        $this->speed_limit = get_setting('speed_limit');
    }
}