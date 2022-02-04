<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use App\Models\Employee;
use App\Models\EmployeeProject;
use Illuminate\Support\Arr;

class Indexboq extends Component
{
    use WithPagination;
    public $date,$keyword,$coordinator_id,$coordinators=[],$selected_data;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        if(check_access('po-tracking-nonms.index-regional')){
            $data = PoTrackingNonms::where('region', isset(\Auth::user()->employee->region->region)?\Auth::user()->employee->region->region:'')
                                    ->where('type_doc', '2')
                                    ->orderBy('id', 'DESC'); 
        }else $data = PoTrackingNonms::where('type_doc', '2')->orderBy('id', 'DESC');
        
        if($this->keyword) $data->where(function($table){
                            $table->where('po_no',"LIKE","%{$this->keyword}%")
                                    ->orWhere('region',"LIKE","%{$this->keyword}%")
                                    ->orWhere('site_id',"LIKE","%{$this->keyword}%")
                                    ->orWhere('site_name',"LIKE","%{$this->keyword}%")
                                    ->orWhere('pekerjaan',"LIKE","%{$this->keyword}%");
                        });
        if($this->date) $data->whereDate('created_at',$this->date);
        
        return view('livewire.po-tracking-nonms.indexboq')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $this->coordinators = get_user_from_access('is-coordinator',$client_project_ids,\Auth::user()->employee->region_id);
    }

    public function set_data(PoTrackingNonms $selected_data){
        $this->selected_data = $selected_data;
    }

    public function assign_coordinator()
    {
        $this->validate([
            'coordinator_id'=>'required'
        ]);
        $this->selected_data->coordinator_id = $this->coordinator_id;
        $this->selected_data->save();
        
        $message = 'Work order number '. $this->selected_data->no_tt." need your action.";
        if(isset($this->selected_data->coordinator->device_token)) push_notification_android($this->selected_data->coordinator->device_token,"PO Tracking Non MS" ,$message,10);
        
        $this->emit('modal','hide');
    }
}