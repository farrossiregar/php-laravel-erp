<?php

namespace App\Http\Livewire\TroubleTicket;

use TroubleTicketHelper;
use App\Models\Employee;
use App\Models\TroubleTicket;
use App\Models\TroubleTicketCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads,WithPagination;
    public $trouble_ticket_number,$category,$description,$employee_id,$employee,$show_category_others=false,$trouble_ticket_category,$trouble_ticket_category_others;
    public $type=1,$lokasi_kejadian,$selected,$risk,$note,$status=3,$reason,$recommendation,$tanggal_kejadian,$file;
    public $filter_type;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = TroubleTicket::with(['pic','employee'])->orderBy('id','DESC');

        if(!check_access('trouble-ticket.pickup')) 
            $data->where('employee_id',\Auth::user()->employee->id);

        return view('livewire.trouble-ticket.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->trouble_ticket_number = TroubleTicketHelper::generate_number();
        $this->category = TroubleTicketCategory::orderBy('name','ASC')->get();
        $this->employee = Employee::orderBy('name','ASC')->get();
    }

    public function updated($propertyName)
    {
        if($propertyName=='trouble_ticket_category_id') $this->show_category_others = $this->$propertyName=='others' ? true : false;
    }

    public function set_(TroubleTicket $data)
    {
        $this->selected = $data;
    }

    public function solved()
    {
        if($this->status==4){
            $this->validate([
                'status'=>'required',
                'reason'=>'required',
                'recommendation'=>'required'
            ]);
        }else{
            $this->validate([
                'status'=>'required',
                'note'=>'required'
            ]);
        }

        $this->selected->status = $this->status;
        $this->selected->end_date = date('Y-m-d H:i:s');
        $this->selected->note = $this->note;
        $this->selected->save();
        
        $description = "Resolved By : ". \Auth::user()->employee->name ."\n";

        if(isset($this->selected->employee->device_token)) push_notification_android($this->selected->employee->device_token,"TT Number #".$this->selected->trouble_ticket_number ." Resolved" ,$description,6,1,1);
        
        session()->flash('message-success',__("Trouble Ticket #{$this->selected->trouble_ticket_number} ".($this->status==3 ? "Solve" : "Not Solve")));
        
        \LogActivity::add('[web] Trouble Ticket solved #'. $this->selected->trouble_ticket_number);

        return redirect()->route('trouble-ticket.index');
    }

    public function accept()
    {
        $this->validate([
            'risk' => 'required'
        ]);
        $this->selected->status = 2;
        $this->selected->employee_pic_id = \Auth::user()->employee->id;
        $this->selected->trouble_ticket_number = TroubleTicketHelper::generate_number();
        $this->selected->start_date = date('Y-m-d H:i:s');
        $this->selected->type_risk  = $this->risk;
        $this->selected->save();
        
        $description = "Pick-up By : ". \Auth::user()->employee->name ."\n";

        if(isset($this->selected->employee->device_token)) 
            push_notification_android($this->selected->employee->device_token,"TT Number #".$this->selected->trouble_ticket_number ." Pick-up" ,$description,6,1,1);
        
        \LogActivity::add('[web] Trouble Ticket Accept #'. $this->selected->trouble_ticket_number);

        session()->flash('message-success',__("Accepted and Generate Trouble Ticket Number #{$this->selected->trouble_ticket_number}"));
        
        return redirect()->route('trouble-ticket.index');
    }

    public function save()
    {
        $this->validate([
            'description' => 'required',
            'trouble_ticket_category' => 'required',
            'lokasi_kejadian' => 'required'
        ]);

        if($this->file!="") {
            $this->validate([
                'file' => 'file|mimes:xlsx,csv,xls,doc,docx,pdf,jpg,jpeg,png|max:51200', //] 50MB Max
                ]
            );
        }
        $data = new TroubleTicket();
        $data->employee_id = \Auth::user()->employee->id;
        $data->trouble_ticket_category = $this->trouble_ticket_category;
        $data->trouble_ticket_category_others = $this->trouble_ticket_category_others;
        $data->description = $this->description;
        $data->tanggal_kejadian = $this->tanggal_kejadian;
        $data->lokasi = $this->lokasi_kejadian;
        $data->status = 1;
        $data->save();

        if($this->file!="") {
            $name = "image.".$this->file->extension();
            $this->file->storePubliclyAs("public/trouble-ticket/{$data->id}", $name);
            $data->file = "storage/trouble-ticket/{$data->id}/{$name}";
            $data->save();
        }

        // find IT Support
        $it = get_user_from_access('trouble-ticket.pickup');
        foreach($it as $user){
            push_notification_android($user->device_token,"Trouble Ticket #".\Auth::user()->employee->name ." - ". $this->trouble_ticket_category ,$this->description,6,1,1);
        }

        \LogActivity::add('[web] Trouble Ticket Store #ID-'.$data->id);


        session()->flash('message-success',__("Trouble Ticket submited"));
        
        return redirect()->route('trouble-ticket.index');
    }

    public function set_closed(TroubleTicket $data)
    {
        $data->status = 4;
        $data->approve_date = date('Y-m-d H:i:s');
        $data->save();
        
        $description = "Closed By : ". \Auth::user()->employee->name ."\n";

        \LogActivity::add('[web] Trouble Ticket Closed #'. $data->trouble_ticket_number);

        if(isset($data->pic->device_token)) 
            push_notification_android($data->pic->device_token,"TT Number #".$data->trouble_ticket_number ." Closed" ,$description,6,1,1);

        session()->flash('message-success',__("Closed Troubled Ticket #{$data->trouble_ticket_number}"));
        
        return redirect()->route('trouble-ticket.index');
    }
}
