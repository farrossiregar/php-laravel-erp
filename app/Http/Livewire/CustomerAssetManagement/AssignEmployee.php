<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;

class AssignEmployee extends Component
{
    public $data,$selected_id,$assign=false,$employee_id;
    public function render()
    {
        return view('livewire.customer-asset-management.assign-employee');
    }

    public function mount(CustomerAssetManagement $data){
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
        if($this->employee_id){
            $this->data->employee_id = $this->employee_id;
            $this->data->save();
        }
        $this->selected_id = '';
        $this->assign = false;
        $this->emit('refresh-page');
    }
}
