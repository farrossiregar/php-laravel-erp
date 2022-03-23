<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use App\Models\Site;

class AssignEmployee extends Component
{
    public $data,$selected_id,$assign=false,$user_id;

    protected $listeners = ['refresh-assign'=>'$refresh'];
    
    public function render()
    {
        return view('livewire.sites.assign-employee');
    }

    public function mount(Site $data)
    {
        $this->data = $data;
    }

    public function set_assign($id)
    {
        $this->selected_id = $id;
        $this->assign = true;
    }

    public function cancel($id)
    {
        $this->selected_id = '';
        $this->assign = false;
    }

    public function save()
    {
        if($this->user_id){
            $this->data->employee_id = $this->user_id;
            $this->data->save();
        }
        $this->selected_id = '';
        $this->assign = false;
        $this->emitSelf('refresh-assign');
    }
}