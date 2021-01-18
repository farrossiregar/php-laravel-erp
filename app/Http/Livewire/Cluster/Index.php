<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cluster;
use App\Helpers\GeneralHelper;

class Index extends Component
{
    public $keyword;
    public $clusterdel;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = Cluster::orderBy('id','DESC');

        if(check_access_controller('cluster.index') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }

        return view('livewire.cluster.index')->with(['data'=>$data->paginate(100)]);
    }
}
