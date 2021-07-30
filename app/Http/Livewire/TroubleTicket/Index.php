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
        
        if(!empty($this->file)){
            foreach($this->file as $file){
                $new_file = new TrainingMaterialFile();
                $new_file->training_material_id = $data->id;
                $name = $file->getClientOriginalName();
                $file->storeAs("public/training-material/{$data->id}", $name);
                $new_file->file = "storage/training-material/{$data->id}/{$name}";
                $new_file->name = $file->getClientOriginalName();
                $new_file->file_ext = $file->extension();
                $new_file->save();
            }
        }
    }
}
