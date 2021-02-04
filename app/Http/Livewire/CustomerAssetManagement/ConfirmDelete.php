<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;

class ConfirmDelete extends Component
{
    protected $listeners = ['econfirm-delet'=>'confirmDelete'];
    public $selected_id,$data;
    public function render()
    {
        return view('livewire.customer-asset-management.confirm-delete');
    }
    public function confirmDelete($id)
    {
        $this->selected_id = $id;
        $this->data = \App\Models\CustomerAssetManagement::find($this->selected_id);
    }
    public function delete()
    {
        \App\Models\CustomerAssetManagement::find($this->selected_id)->delete();
        $this->emit('refresh-page');
    }
}
