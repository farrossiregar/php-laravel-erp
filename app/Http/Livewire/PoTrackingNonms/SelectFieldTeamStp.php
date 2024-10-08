<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonms;

class SelectFieldTeamStp extends Component
{
    public $data,$edit=false,$field_team_id;
    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        return view('livewire.po-tracking-nonms.select-field-team-stp');
    }

    public function mount(PoTrackingNonms $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $this->data->field_team_id = $this->field_team_id;
        $this->data->save();
        $this->edit = false;

        $notif = Employee::where('id', $this->field_team_id)->first();
        $nameuser = $notif->name;
        $emailuser = $notif->email;
        $phoneuser = $notif->telepon;

        $message = "*Dear Field Team - ".$nameuser."*\n\n";
        $message .= "*You are assigned to Captured Field Data ".$this->data->no_tt." pada ".date('d M Y H:i:s')."*\n\n";
        send_wa(['phone'=> $phoneuser,'message'=>$message]);  

        $this->emit('refresh-page');
    }
}
