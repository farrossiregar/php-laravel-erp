<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonmsPo;

class ProcessExtraBudget extends Component
{
    protected $listeners = ['set-data'=>'setData'];
    public $note,$selected_data;
    public function render()
    {
        return view('livewire.po-tracking-nonms.process-extra-budget');
    }

    public function setData(PoTrackingNonmsPo $id)
    {
        $this->selected_data = $id;
    }

    public function approve()
    {
        $this->selected_data->status_extra_budget = 2;
        $this->selected_data->save();

        \LogActivity::add('[web] PO Non MS - Approve Extra Budget');
        
        session()->flash('message-success',"Extra budget Acknowledge");

        return redirect()->route('po-tracking-nonms.index');

        // $this->emit('message-success',"Extra budget Acknowledge");
        // $this->emit('refresh');
        // $this->emit('modal','hide');   
    }

    public function reject()
    {
        $this->validate([
            'note'=>'required'
        ]);

        $this->selected_data->status_extra_budget = 3;
        $this->selected_data->note_extra_budget = $this->note;
        $this->selected_data->save();

        \LogActivity::add('[web] PO Non MS - Reject Extra Budget');

        session()->flash('message-success',"Extra budget Acknowledge");

        return redirect()->route('po-tracking-nonms.index');
        
        // $this->emit('message-success',"Extra budget Acknowledge");
        // $this->emit('refresh');
        // $this->emit('modal','hide');   
    }
}
