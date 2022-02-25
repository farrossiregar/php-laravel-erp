<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonms;

class ExtraBudget extends Component
{
    use WithFileUploads;
    public $extra_budget,$file_extra_budget,$selected_data;
    protected $listeners = ['set-data'=>'setData'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.extra-budget');
    }

    public function setData(PoTrackingNonms $id)
    {
        $this->selected_data = $id;
    }

    public function save()
    {
        $this->validate([
            'file_extra_budget'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'extra_budget'=>'required'
        ]);

        $file_name =  "extra_budget.".$this->file_extra_budget->extension();
        $this->file_extra_budget->storeAs("public/po-tracking-nonms/{$this->selected_data->id}", $file_name);
        
        $this->selected_data->extra_budget = $this->extra_budget;
        $this->selected_data->extra_budget_file = "storage/po-tracking-nonms/{$this->selected_data->id}/{$file_name}";
        $this->selected_data->status_extra_budget = 1; // Finance
        $this->selected_data->save();

        $this->emit('message-success',"Extra budget submited");
        $this->emit('refresh');
        $this->emit('modal','hide');   
    }
}