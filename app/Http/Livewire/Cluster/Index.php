<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cluster;
use App\Helpers\GeneralHelper;

class Index extends Component
{
    public $keyword,$region_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emit-delete-hide' => '$refresh'];
    public function render()
    {
        $data = Cluster::orderBy('id','DESC');
        if($this->keyword) $ata = $data->where('name','LIKE',"{$this->keyword}");
        if($this->region_id) $ata = $data->where('region_id',$this->region_id);
        if(check_access_controller('cluster.index') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }

        return view('livewire.cluster.index')->with(['data'=>$data->paginate(100)]);
    }
}
