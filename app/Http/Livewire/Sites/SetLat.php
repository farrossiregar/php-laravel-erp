<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use App\Models\Site;

class SetLat extends Component
{
    public $data,$edit=false,$lat;

    public function render()
    {
        return view('livewire.sites.set-lat');
    }
    
    public function mount(Site $id)
    {
        $this->data = $id;
        $this->lat = $this->data->lat;
    }

    public function save()
    {
        $this->data->lat = $this->lat;
        $this->data->save();
        $this->edit = false;
    }
}
