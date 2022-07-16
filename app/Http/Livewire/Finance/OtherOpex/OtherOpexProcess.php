<?php

namespace App\Http\Livewire\Finance\OtherOpex;

use Livewire\Component;
use App\Models\AccountPayableOtheropex;

class OtherOpexProcess extends Component
{
    public $note,$selected;
    protected $listeners = ['check_id'];
    public function render()
    {
        return view('livewire.finance.other-opex.other-opex-process');
    }

    public function check_id(AccountPayableOtheropex $selected)
    {
        $this->selected = $selected;
    }

    public function approve()
    {
        $this->selected->status = 1; // approve
        $this->save();
    }

    public function reject()
    {
        $this->selected->status = 3; // reject
        $this->save();
    }

    public function save()
    {
        $this->selected->app_staff_note = $this->note;
        $this->selected->save();
        
        // save status master data
        $this->selected->status=1;
        $this->selected->master->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('other-opex.index');
    }
}
