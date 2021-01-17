<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;

class Delete extends Component
{
    public $region_id;
    protected $listeners = ['emit-delete' => 'emitDelete'];
    public function render()
    {
        return view('livewire.region.delete');
    }
    public function emitDelete($id)
    {
        $this->region_id = $id;
    }
    public function delete()
    {
        \App\Models\Region::find($this->region_id)->delete();
        $this->emit('emit-delete-hide');
        $this->reset();
    }
}
