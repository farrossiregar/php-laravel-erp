<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonmsPo;

class ExtraBudget extends Component
{
    use WithFileUploads;
    public $extra_budget,$file_extra_budget,$selected_data;
    protected $listeners = ['set-data'=>'setData'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.extra-budget');
    }

    public function setData(PoTrackingNonmsPo $id)
    {
        $this->selected_data = $id;
    }

    public function save()
    {
        $this->validate([
            // 'file_extra_budget'=>'required|mimes:jpeg,png,jpg,gif,svg,pdf,xls,xlsx|max:2048',
            'extra_budget'=>'required'
        ]);

        // $file_name =  "extra_budget.".$this->file_extra_budget->extension();
        // $this->file_extra_budget->storeAs("public/po-tracking-nonms/{$this->selected_data->id}", $file_name);
        
        $this->selected_data->extra_budget = $this->extra_budget;
        // $this->selected_data->extra_budget_file = "storage/po-tracking-nonms/{$this->selected_data->id}/{$file_name}";
        $this->selected_data->status_extra_budget = 1; // Finance
        $this->selected_data->save();

        \LogActivity::add('[web] PO Fuel Reimbursement - Extra Budget Requested');

        session()->flash('message-success',"Extra budget requested");

        return redirect()->route('po-tracking-nonms.index');

        // $this->emit('message-success',"Extra budget requested");
        // $this->emit('refresh');
        // $this->emit('modal','hide');   
    }
}