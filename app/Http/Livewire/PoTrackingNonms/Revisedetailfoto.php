<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Revisedetailfoto extends Component
{
    protected $listeners = [
        'modalrevisedetailfoto'=>'revisedetailfoto',
    ];

    use WithFileUploads;
    public $selected_id;
    public $note;

    public function render()
    {

        return view('livewire.po-tracking-nonms.revisedetailfoto');
    }

    public function revisedetailfoto($id)
    {
        $this->selected_id = $id;
        
    }

    public function save()
    {
        $user = \Auth::user();

        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();

        $data->status_fielddata = 0;
        $data->note_status_fielddata = $this->note;
        $data->save();
        
        session()->flash('message-success',"Success!, Photo by Field Team is Declined");
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
