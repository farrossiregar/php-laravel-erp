<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;
use App\Models\PoTrackingNonmsBast;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class PoCreateBast extends Component
{
    use WithFileUploads;
    
    public $data,$active_tab=null,$ordering=0,$description,$selected_bast;
    public $bast_number,$bast_date,$gr_number,$gr_date,$works,$project,$payment_amount,$extra_budget,$file_extra_budget;
    public function render()
    {
        return view('livewire.po-tracking-nonms.po-create-bast');
    }

    public function mount(PoTrackingNonmsPo $id)
    {
        $this->data = $id;
    }

    public function store()
    {

        if($this->file_extra_budget){
            $this->validate([
                'file_extra_budget'=>'required|mimes:jpeg,png,jpg,gif,svg,pdf,xls,xlsx|max:2048',
            ]);

            $file_name =  "extra_budget.".$this->file_extra_budget->extension();
            $this->file_extra_budget->storeAs("public/po-tracking-nonms/{$this->data->id}", $file_name);
            $this->data->extra_budget_file = "storage/po-tracking-nonms/{$this->data->id}/{$file_name}";
        }
        
        $this->data->works = $this->works;
        $this->data->project = $this->project;
        $this->data->bast_number = $this->bast_number;
        $this->data->bast_date = $this->bast_number;
        $this->data->gr_number = $this->gr_number;
        if($this->gr_date) $this->data->gr_date = $this->gr_date;
        $this->data->regional_employee_id = \Auth::user()->employee->id;
        // $this->data->extra_budget = $this->extra_budget;
        // $this->data->status_extra_budget = 1;
        $this->data->save();
    }

    public function save()
    {
        $this->store();
        $this->emit('message-success','Data saved.');
    }

    public function submit()
    {
        $this->validate([
            'bast_number' => ['required',Rule::unique('po_tracking_nonms_po')],
            'bast_date' => 'required',
            'works' => 'required',
            'project' => 'required'
        ]);

        $this->store();
        $this->data->status = 1;
        $this->data->save();

        session()->flash('message-success',"BAST submitted");
        
        return redirect()->route('po-tracking-nonms.index');
    }

    public function delete_image(PoTrackingNonmsBast $id)
    {
        $id->delete();
        $this->emit('message-success','Image deleted.');
        $this->data = PoTrackingNonmsPo::find($this->data->id);
    }

    public function set_id(PoTrackingNonmsBast $id)
    {
        $this->selected_bast = $id;
        $this->ordering = $id->ordering;
        $this->description = $id->description;
    }

    public function save_bast()
    {
        if($this->selected_bast) {
            $this->selected_bast->ordering = $this->ordering;
            $this->selected_bast->description = $this->description;
            $this->selected_bast->save();
        }

        $this->emit('message-success','Data saved.');
        $this->data = PoTrackingNonmsPo::find($this->data->id);
    }
}