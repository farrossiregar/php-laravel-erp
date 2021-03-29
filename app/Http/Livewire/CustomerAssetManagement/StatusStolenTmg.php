<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;

class StatusStolenTmg extends Component
{
    public $data;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        return view('livewire.customer-asset-management.status-stolen-tmg');
    }

    public function mount(CustomerAssetManagement $data)
    {
        $this->data = $data;
    }

    public function verify()
    {
        \LogActivity::add('Verify Stolen TMG : '. $this->data->id);

        $this->data->status=2;
        $this->data->save();
        $this->emit('refresh-page');
    }

    public function revisi()
    {
        \LogActivity::add('Revisi Stolen TMG : '. $this->data->id);

        $this->data->status = 0;
        $this->data->is_submit = 0;
        $this->data->is_revisi = 1;
        $this->data->is_stolen = 0;
        $this->data->save();
        $this->emit('refresh-page');
    }
}