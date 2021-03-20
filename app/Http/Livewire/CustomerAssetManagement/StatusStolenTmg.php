<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;

class StatusStolenTmg extends Component
{
    public $data,$confirm_stolen=false;

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

        $this->data->status = 3;
        $this->data->save();
        $this->emit('refresh-page');
    }
}