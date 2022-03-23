<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use App\Models\Site;

class SetLong extends Component
{
    public $data,$edit=false,$long;

    public function render()
    {
        return view('livewire.sites.set-long');
    }
    
    public function mount(Site $id)
    {
        $this->data = $id;
        $this->long = $this->data->long;
    }

    public function save()
    {
        $this->data->long = $this->long;
        $this->data->save();
        $this->edit = false;
    }
}
