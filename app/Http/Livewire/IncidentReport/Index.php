<?php

namespace App\Http\Livewire\IncidentReport;

use IncidentReportHelper;
use App\Models\IncidentReport;
use Livewire\Component;
use App\Mail\IncidentReportMail;
use Livewire\WithFileUploads;

class Index extends Component
{
    public $incident_report_number,$tanggal_kejadian,$description,$employee,$show_category_others=false,$category,$trouble_ticket_category_others;
    public $type=1,$lokasi,$risk,$note,$selected,$file,$impact,$root_cause,$action_plan,$recommendation;
    public $filter_type,$keyword;
    use WithFileUploads;

    public function render()
    {
        $data = IncidentReport::with('employee')->orderBy('id','DESC');
        if($this->keyword) $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('incident_report') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });
        return view('livewire.incident-report.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->tanggal_kejadian = date('Y-m-d');
    }

    public function updated($propertyName)
    {
        if($propertyName=='category') $this->show_category_others = $this->$propertyName=='Other cyber security issue' ? true : false;
    }

    public function set_(IncidentReport $data)
    {
        $this->selected = $data;
    }

    public function submit_solved($status)
    {
        $this->validate([
            'impact' => 'required',
            'root_cause' => 'required',
            'action_plan' => 'required',
            'recommendation' => 'required',
        ]);
        $this->selected->status = $status;// solved
        $this->selected->impact = $this->impact;
        $this->selected->root_cause = $this->root_cause;
        $this->selected->action_plan = $this->action_plan;
        $this->selected->recommendation = $this->recommendation;
        $this->selected->end_date = date('Y-m-d');
        $this->selected->save();

        // notif to requester
        if(isset($this->selected->employee->email))  
            \Mail::to($this->selected->employee->email)->send(new IncidentReportMail($this->selected));
        
        session()->flash('message-success',__("Incident report #{$this->selected->incident_number} ".($status==3 ? "solved" : "unsolved")));
        
        return redirect()->route('incident-report.index');
    }

    public function approve()
    {
        $this->validate([
            'risk' => 'required'
        ]);
        
        $this->selected->incident_number = IncidentReportHelper::generate_number();
        $this->selected->risk = $this->risk;
        $this->selected->status = 2; // approve
        $this->selected->employee_pic_id = \Auth::user()->employee->id;
        $this->selected->start_date = date('Y-m-d');
        $this->selected->save();

        // notif to requester
        if(isset($this->selected->employee->email)) 
            \Mail::to($this->selected->employee->email)->send(new IncidentReportMail($this->selected));

        if($this->risk=='High'){
            $notification = get_user_from_access('incident-report.risk-high-notification');
            foreach($notification as $user){
                \Mail::to($user->email_employee)->send(new IncidentReportMail($this->selected));
            }

            $notification = get_user_from_access('incident-report.risk-medium-notification');
            foreach($notification as $user){
                \Mail::to($user->email_employee)->send(new IncidentReportMail($this->selected));
            }
        }

        if($this->risk=='Medium'){
            $notification = get_user_from_access('incident-report.risk-medium-notification');
            foreach($notification as $user){
                \Mail::to($user->email_employee)->send(new IncidentReportMail($this->selected));
            }
        }
        
        if($this->risk=='Low'){
            $notification = get_user_from_access('incident-report.risk-low-notification');
            foreach($notification as $user){
                \Mail::to($user->email_employee)->send(new IncidentReportMail($this->selected));
            }

            $notification = get_user_from_access('incident-report.risk-medium-notification');
            foreach($notification as $user){
                \Mail::to($user->email_employee)->send(new IncidentReportMail($this->selected));
            }
        }
        // insert table history
        table_history('employee_pic',$this->selected->id,'incident_report',\Auth::user()->employee);
        $this->emit('hide-modal-approve');
    }

    public function save()
    {
        $this->validate([
            'description' => 'required',
            'category' => 'required',
            'tanggal_kejadian' => 'required',
            'lokasi' => 'required',
        ]);
        $data = new IncidentReport();
        $data->status = 1; //Open
        $data->tanggal_kejadian = $this->tanggal_kejadian;
        $data->lokasi = $this->lokasi;
        $data->employee_id = \Auth::user()->employee->id;
        $data->category = $this->category == 'Other cyber security issue' ? $this->trouble_ticket_category_others : $this->category;
        $data->description = $this->description;
        $data->save(); 

        if($this->file!=""){
            $file = 'file'.date('Ymdhis').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/incident-report/'.$data->id,$file);
            $data->file = "storage/incident-report/{$data->id}/{$file}";
            $data->save();
        }

        $pic = get_user_from_access('incident-report.is-pic');
        
        foreach($pic as $user){
            \Mail::to($user->email_employee)->send(new IncidentReportMail($data));
        }

        // insert table history
        table_history('employee',$data->id,'incident_report',\Auth::user()->employee);

        $this->emit('message-success',__('Incident report submited'));
        $this->emit('hide-modal');
    }
}
