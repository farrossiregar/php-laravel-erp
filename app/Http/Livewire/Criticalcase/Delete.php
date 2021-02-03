<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\Cluster;

class Delete extends Component
{
    public $cluster_id;
    protected $listeners = ['emit-delete' => 'clusterDelete'];
    public function render()
    {
        return view('livewire.cluster.delete');
    }
    public function clusterDelete($id)
    {
        $this->cluster_id = $id;
    }
    public function delete()
    {
        \App\Models\Cluster::find($this->cluster_id)->delete();
        $this->emit('emit-delete-hide');
        $this->reset();
    }

}
