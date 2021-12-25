<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use App\Models\Criticalcase;
use App\Mail\CriticalCaseActionPoint;

class Edit extends Component
{
    protected $listeners = [
                            'update-critical'=>'updateCritical',
                            //'refresh-page'=>'$refresh'
                        ];
    public $selected_id, $data, $date, $pic, $last_update, $region, $activity_handling;
    public $action_point,$type;
    public function render()
    {
        return view('livewire.criticalcase.update-critical');
    }
    public function updateCritical($id)
    {
        $this->selected_id = $id;

        $this->data                 = Criticalcase::where('id', $this->selected_id)->first();
        $this->pic                  = $this->data->pic;
        $this->date                 = $this->data->date;
        $this->last_update          = $this->data->last_update;
        $this->region               = $this->data->region;
        $this->action_point         = $this->data->action_point;
        $this->activity_handling    = $this->data->activity_handling;
    }

    public function update(){
        $this->validate([
            'action_point' => 'required',
            'type' =>'required'
        ]);
        $data = Criticalcase::where('id',$this->selected_id)->first();
        $data->action_point = $this->action_point;
        $data->type = $this->type;
        $data->status_submit = 1; 
        $data->save();
        // foreach(get_user_from_access('critical-case.notification-action-point') as $user){
        //     $message = "*{$this->data->activity_handling}*\n\n";
        //     $message .= $this->type==1?"*Repetitive*" : "*Non Repetitive*";
        //     $message .= "\n".$this->action_point;

        //     send_wa(['phone'=>$user->telepon,'message'=>$message]);
        //     \Mail::to($user->email)->send(new CriticalCaseActionPoint($data));
        // }

        $this->emit('refresh-page');
    }
}