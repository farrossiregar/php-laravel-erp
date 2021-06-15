<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\PreventiveMaintenance as PreventiveMaintenanceModel;

class PreventiveMaintenance extends Component
{
    public $site_id,$description,$due_date,$project_id,$site_report,$site_owner;
    
    protected $listeners = ['refresh-page'=>'$refresh'];
    
    public function render()
    {
        $data = PreventiveMaintenanceModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.preventive-maintenance')->with(['data'=>$data->paginate(100)]);
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
        $data->description  = $this->description;
        $data->due_date = $this->due_date;
        $data->project_id = $this->project_id;
        $data->save();

        $this->reset(['site_id','description','due_date','project_id']);
        $this->emit('message-success','Preventive Maintenance Added');
        $this->emit('refresh-page');
    }
}
