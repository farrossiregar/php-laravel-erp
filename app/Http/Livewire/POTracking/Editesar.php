<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingPds;


class Editesar extends Component
{
    protected $listeners = [
                            'update-critical'=>'updateCritical',
                            'refresh-page'=>'$refresh'
                        ];
    public $data, $project_name;
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit-esar') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }

        $data           = $this->data;
        $project_name   = $this->project_name;
        // return view('livewire.po-tracking.edit');
        return view('livewire.po-tracking.edit-esar')->with(compact('data'));
    }


    public function mount($id)
    {
        $this->data             = PoTrackingPds::where('id', $id)->first();  
        $this->project_name     = $this->data->project_name;  
        
        
    }

    // public function updateCritical($id)
    // {
    //     $this->selected_id = $id;

    //     $this->data                 = Criticalcase::where('id', $this->selected_id)->first();
    //     $this->pic                  = $this->data->pic;
    //     $this->date                 = $this->data->date;
    //     $this->last_update          = $this->data->last_update;
    //     $this->region               = $this->data->region;
    //     $this->action_point         = $this->data->action_point;
    //     $this->activity_handling    = $this->data->activity_handling;
    // }


    // public function update(){
    //     $data = Criticalcase::where('id',$this->selected_id)->first();
    //     $data->action_point = $this->action_point;
    //     $data->save();
    //     $this->emit('refresh-page');
    //     return view('livewire.criticalcase.update-critical');
    // }
}
