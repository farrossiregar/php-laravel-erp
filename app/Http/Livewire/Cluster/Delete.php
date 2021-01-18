<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use App\Models\Cluster;

class Delete extends Component
{
    // public $data;
    // public $region_id;
    // public $name;
    // public $message;

    // public function render()
    // {
    //     $delete = Cluster::find($this->id);

    //     $delete->delete(); 
    //     session()->flash('message-error','Delete Success.'); 
    //     return redirect()->to('cluster');
    // }
    // public function mount($id)
    // {
    //     $this->data         = Cluster::find($id);
    //     $this->id         = $this->data->id;
    // }

    public $region_id;
    protected $listeners = ['cluster-delete' => 'clusterDelete'];
    public function render()
    {
        return view('livewire.cluster.delete');
    }
    public function clusterDelete($id)
    {
        $this->region_id = $id;
    }
    public function delete()
    {
        \App\Models\Cluster::find($this->id)->delete();
        $this->clusterdel('cluster-delete-hide');
        $this->reset();
    }

}
