<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Updatelatitude extends Component
{
    protected $listeners = [
        'modalupdatelat'=>'updatelat',
    ];

    use WithFileUploads;
    public $lat;
    public $selected_id;

    
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.updatelatitude');
    }

    public function updatelat($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
       
        $data = \App\Models\DopHomebaseMaster::where('id', $this->selected_id)->first();
        $data->lat = $this->lat;
        $data->save();

        session()->flash('message-success',"Latitude updated success");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}
