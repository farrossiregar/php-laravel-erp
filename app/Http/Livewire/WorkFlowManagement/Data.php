<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeeProject;
use App\Models\WorkFlowManagement;
use App\Mail\GeneralEmail;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['project_id'];
    public $perpage=100,$keyword,$created_at,$region,$problem,$employees,$project_id,$selected_id,$employee_id;
    public function render()
    {
        $data = WorkFlowManagement::orderBy('updated_at','DESC');
        if($this->keyword) $data  = $data->where(function($table){
                                        $table->where('name','LIKE',"{$this->keyword}")
                                            ->orWhere('id_','LIKE',"{$this->keyword}")
                                            ->orWhere('servicearea4','LIKE',"{$this->keyword}")
                                            ->orWhere('city','LIKE',"{$this->keyword}")
                                            ->orWhere('servicearea2','LIKE',"{$this->keyword}")
                                            ->orWhere('region','LIKE',"{$this->keyword}")
                                            ->orWhere('asp','LIKE',"{$this->keyword}")
                                            ->orWhere('region_dan_asp_info','LIKE',"{$this->keyword}")
                                            ->orWhere('skills','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_assign','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_accept','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_close_manual','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_close_auto','LIKE',"{$this->keyword}")
                                            ->orWhere('mttr','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_assign','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_accept','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_close_manual','LIKE',"{$this->keyword}")
                                            ->orWhere('final_remark','LIKE',"{$this->keyword}");
                                        });
        if($this->created_at) $data = $data->whereDate('created_at',$this->created_at);
        if($this->region) $data = $data->where('region',$this->region);
        if($this->problem) $data->where('problem',$this->problem);
        $count = clone $data;
        return view('livewire.work-flow-management.data')->with(['data'=>$data->paginate($this->perpage),'count'=>$count->count()]);
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        // TE Engineer
        $this->employees = EmployeeProject::select('employees.*')
                                        //->where('employee_projects.client_project_id',session()->get('project_id'))
                                        ->join('employees','employees.id','=','employee_projects.employee_id')
                                        ->whereIn('user_access_id',[85])
                                        ->groupBy('employees.id')
                                        ->get();
    }
    
    public function set_data(WorkFlowManagement $data)
    {
        $this->selected_id = $data;
    }

    public function submit_change_pic()
    {
        $this->validate([
            'employee_id' => 'required'
        ]);
        $this->selected_id->employee_id = $this->employee_id;
        $this->selected_id->problem = 'FT not resolve WO';
        $this->selected_id->notif_coordinator = date('Y-m-d H:i:s',strtotime("+30 minutes"));
        $this->selected_id->notif_sm = date('Y-m-d H:i:s',strtotime("+60 minutes"));
        $this->selected_id->notif_osm = date('Y-m-d H:i:s',strtotime("+120 minutes"));
        $this->selected_id->save();

        $message = "You have assigned WO please check your EPL E-PM Account";

        if(isset($this->selected_id->employee->email)){
            $message = "<p>Dear {$this->selected_id->employee->name}<br />{$message}</p>";
            \Mail::to($this->selected_id->employee->email)->send(new GeneralEmail("[PMT E-PM] Work Force Management",$message));
        }

        if(isset($this->selected_id->employee->device_token))
            push_notification_android($this->selected_id->employee->device_token,'Work Force Management',strip_tags($message),9);

        $this->emit('message-success','PIC Change.');
        $this->emit('refresh-page');
    }
}
