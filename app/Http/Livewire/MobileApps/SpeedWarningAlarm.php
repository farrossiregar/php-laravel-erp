<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\SpeedWarningAlarm as ModelSpeedWarningAlarm;

class SpeedWarningAlarm extends Component
{
    public $speed_limit;
    public function render()
    {
        $data = ModelSpeedWarningAlarm::orderBy('id');

        return view('livewire.mobile-apps.speed-warning-alarm')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->speed_limit = get_setting('speed_limit');
    }

    public function set_speed_warning()
    {
        $this->validate([
            'speed_limit' => 'required'
        ]);

        update_setting('speed_limit',$this->speed_limit);

        $this->speed_limit = get_setting('speed_limit');
    }
}