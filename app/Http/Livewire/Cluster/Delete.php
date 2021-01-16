<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use App\Models\Cluster;
use App\Helpers\GeneralHelper;

class Delete extends Component
{
    public $data;
    public $region_id;
    public $name;
    public $message;

    public function render()
    {
        $delete = Cluster::find($this->id);

        $delete->delete(); 
        session()->flash('message-error','Delete Success.'); 
        return redirect()->to('cluster');
        
    }

    public function mount($id)
    {
        $this->data         = Cluster::find($id);
        
        $this->id         = $this->data->id;
    }

}
