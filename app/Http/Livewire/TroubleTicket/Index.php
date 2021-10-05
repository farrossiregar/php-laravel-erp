<?php

namespace App\Http\Livewire\TroubleTicket;

use TroubleTicketHelper;
use App\Models\Employee;
use App\Models\TroubleTicket;
use App\Models\TroubleTicketCategory;
use Livewire\Component;
class Index extends Component
{
    public $trouble_ticket_number,$category,$description,$employee_id,$employee,$show_category_others=false,$trouble_ticket_category_id,$trouble_ticket_category_others;
    public $type=1,$lokasi,$selected,$risk,$note;
    public $filter_type;

    public function render()
    {
        $data = TroubleTicket::orderBy('id','DESC');

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
        $this->validate([
            'note'=>'required'
        ]);

        $this->selected->status = 3;
        $this->selected->end_date = date('Y-m-d H:i:s');
        $this->selected->note = $this->note;
        $this->selected->save();
        
        $description = "Resolved By : ". \Auth::user()->employee->name ."\n";

        if(isset($this->selected->employee->device_token)) 
            push_notification_android($this->selected->employee->device_token,"TT Number #".$this->selected->trouble_ticket_number ." Resolved" ,$description,6);
    }

    public function accept()
    {
        $this->selected->status = 2;
        $this->selected->employee_pic_id = \Auth::user()->employee->id;
        $this->selected->trouble_ticket_number = TroubleTicketHelper::generate_number();
        $this->selected->start_date = date('Y-m-d H:i:s');
        $this->selected->type_risk  = $this->risk;
        $this->selected->save();
        
        $description = "Pick-up By : ". \Auth::user()->employee->name ."\n";

        if(isset($this->selected->employee->device_token)) 
            push_notification_android($this->selected->employee->device_token,"TT Number #".$this->selected->trouble_ticket_number ." Pick-up" ,$description,6);
    }

    public function save()
    {
        $this->validate([
            'employee_id' => 'required',
            'description' => 'required',
            'trouble_ticket_category_id' => 'required',
        ]);

        if($this->show_category_others){
            $new_category = new TroubleTicketCategory();
            $new_category->name = $this->trouble_ticket_category_others;
            $new_category->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
            $new_category->save();

            $this->trouble_ticket_category_id = $new_category->id;
        }

        $data = new TroubleTicket();
        $data->trouble_ticket_number = $this->trouble_ticket_number;
        $data->employee_id = $this->employee_id;
        $data->trouble_ticket_category_id = $this->trouble_ticket_category_id;
        $data->description = $this->description;
        $data->user_id = \Auth::user()->id;
        $data->save();
    }
}
