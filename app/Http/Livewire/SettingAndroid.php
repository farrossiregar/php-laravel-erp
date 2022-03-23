<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SettingAndroid extends Component
{
    public $speed_limit,$limit_location_of_field_team;

    public function render()
    {
        return view('livewire.setting-android');
    }

    public function mount()
    {
        $this->speed_limit = get_setting('speed_limit');
        $this->limit_location_of_field_team = get_setting('limit_location_of_field_team');
    }

    public function updated($propertyName)
    {
        if($propertyName =='speed_limit'){
            update_setting('speed_limit',$this->speed_limit);
        }
        if($propertyName =='limit_location_of_field_team'){
            update_setting('limit_location_of_field_team',$this->limit_location_of_field_team);
        }
    }
}
