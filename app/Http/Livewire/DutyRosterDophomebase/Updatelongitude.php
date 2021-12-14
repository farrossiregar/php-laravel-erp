<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Updatelongitude extends Component
{
    protected $listeners = [
        'modalupdatelong'=>'updatelong',
    ];

    use WithFileUploads;
    public $long;
    public $selected_id;

    
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.updatelongitude');
    }

    public function updatelong($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
       
        $data = \App\Models\DophomebaseMaster::where('id', $this->selected_id)->first();
        $data->long = $this->long;
        $data->save();

        session()->flash('message-success',"Longitude updated success");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}
