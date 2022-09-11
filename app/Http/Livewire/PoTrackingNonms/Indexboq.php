<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonms;
use App\Models\EmployeeProject;
use App\Models\Employee;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;

class Indexboq extends Component
{
    use WithPagination,WithFileUploads;
    public $date,$keyword,$coordinator_id,$coordinators=[],$selected_data,$is_service_manager=false;
    public $is_coordiantor=false,$field_teams=[],$field_team_id,$url_bast,$note,$file_bast,$file_gr;
    public $extra_budget, $file_extra_budget,$scoope_of_works;
    public $is_finance=false,$wo_id=[],$is_e2e,$is_pmg = false;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh'=>'$refresh'];
    public $filter_field_team_id,$filter_field_teams=[],$total_price_arr=[],$sum_total_request=0,$sum_budget_request=0;
    public function render()
    {
        $data = PoTrackingNonms::with(['field_team','coordinator'])
                            ->withSum('boq','input_price')
                            ->withSum('boq','total_price')
                            ->where('type_doc', 2)
                            ->orderBy('updated_at', 'DESC');
        if(!$this->is_service_manager and !$this->is_e2e and !$this->is_finance and !$this->is_pmg){
            $data->where(function($table){
                $table->where('coordinator_id',\Auth::user()->employee->id)->orWhere('field_team_id',\Auth::user()->employee->id);
            });
        } 

        if($this->is_service_manager) $data->where('region', isset(\Auth::user()->employee->sub_region->name)?\Auth::user()->employee->sub_region->name:''); 
        
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_tracking_nonms_master') as $column){
                $table->orWhere('po_tracking_nonms_master.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });
        if($this->is_finance) $data->where(function($table){
                                    // $table->where('status',1)->orWhere('status',2);
                                });

        if($this->date) $data->whereDate('created_at',$this->date);
        if($this->filter_field_team_id) $data->where('field_team_id',$this->filter_field_team_id);

        if($this->total_price_arr){
            $temp = PoTrackingNonms::with(['field_team','coordinator'])
                            ->withSum('boq','input_price')
                            ->withSum('boq','total_price')
                            ->where('type_doc', 2)
                            ->orderBy('updated_at', 'DESC')
                            ->whereIn('id',$this->total_price_arr)->get();
            
            $this->sum_total_request = 0;$this->sum_budget_request = 0;
            foreach($temp as $item){
                $this->sum_budget_request += $item->boq_sum_total_price;
            }
        }

        return view('livewire.po-tracking-nonms.indexboq')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $this->coordinators = get_user_from_access('is-coordinator',$client_project_ids,\Auth::user()->employee->region_id);
        $this->field_teams = Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->whereIn('client_project_id',$client_project_ids)->get();
        $this->filter_field_teams = PoTrackingNonms::groupBy('field_team_id')->get();
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_coordinator = check_access('is-coordinator');
        $this->is_finance = check_access('is-finance');
        $this->is_e2e = check_access('is-e2e');
        $this->is_pmg = check_access('is-pmg');
    }

    public function updated($propertyName)
    {
        if($propertyName=='wo_id') $this->emit('set_wo',$this->wo_id);
    }

    public function set_data(PoTrackingNonms $id){
        $this->selected_data = $id;
        $this->url_bast = asset($id->bast);
    }

    public function e2e_upload_bast_and_gr()
    {
        $this->validate([
            'file_bast'=>'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image',
            'file_gr'=>'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image'
        ]);

        $bast =  "bast_approved.".$this->file_bast->extension();
        $gr =  "gr_approved.".$this->file_gr->extension();
        $this->file_bast->storeAs("public/po-tracking-nonms/{$this->selected_data->id}", $bast);
        $this->file_gr->storeAs("public/po-tracking-nonms/{$this->selected_data->id}", $gr);
        $this->selected_data->approved_bast = "storage/po-tracking-nonms/{$this->selected_data->id}/{$bast}";
        $this->selected_data->gr_cust = "storage/po-tracking-nonms/{$this->selected_data->id}/{$gr}";
        $this->selected_data->status = 9; // Finance
        $this->selected_data->save();

        \LogActivity::add('[web] PO Non MS - Upload BAS dan GR');

        $this->emit('message-success',"BAST and GR uploaded");
        $this->emit('modal','hide');
    }

    public function e2e_reject_bast()
    {
        $this->validate(['note'=>'required']);
        $this->selected_data->note_e2e_bast = $this->note;
        $this->selected_data->bast_status = 3;
        $this->selected_data->save(); 

        \LogActivity::add('[web] PO Non MS - Reject BAST');

        $this->emit('message-success',"Budget request rejected");
        $this->emit('modal','hide');
    }

    public function e2e_approve_bast()
    {
        $this->validate(['note'=>'required']);
        $this->selected_data->note_e2e_bast = $this->note;
        $this->selected_data->status = 8;
        $this->selected_data->save();

        \LogActivity::add('[web] PO Non MS - Approve BAST');
        
        $this->emit('message-success',"Budget request approved");
        $this->emit('modal','hide');
    }

    public function assign_field_team()
    {
        $this->validate([
            'field_team_id'=>'required',
            'scoope_of_works'=>'required'
        ]);

        $this->selected_data->scoope_of_works = $this->scoope_of_works;
        $this->selected_data->field_team_id = $this->field_team_id;
        $this->selected_data->status = 7;
        $this->selected_data->save();
        
        \LogActivity::add('[web] PO Non MS - Assign Field Team');

        $message =  'Work order number '. $this->selected_data->no_tt.", {$this->scoope_of_works}.";

        if(isset($this->selected_data->field_team->device_token)) push_notification_android($this->selected_data->field_team->device_token,"PO Tracking Non MS" ,$message,10);
        
        $this->emit('modal','hide');
    }

    public function assign_coordinator()
    {
        $this->validate([
            'coordinator_id'=>'required'
        ]);
        $this->selected_data->coordinator_id = $this->coordinator_id;
        $this->selected_data->status = 6;
        $this->selected_data->save();
        
        \LogActivity::add('[web] PO Non MS - Assign Coordinator');

        $message = 'Work order number '. $this->selected_data->no_tt." need your action.";
        if(isset($this->selected_data->coordinator->device_token)) push_notification_android($this->selected_data->coordinator->device_token,"PO Tracking Non MS" ,$message,10);
        
        $this->emit('modal','hide');
    }
}