<?php

namespace App\Http\Livewire\Finance\HqAdministration;

use Livewire\Component;
use App\Models\AccountPayableHqAdministration;

class HqAdministrationProcess extends Component
{
    public $note,$selected;
    protected $listeners = ['check_id'];
    public function render()
    {
        return view('livewire.finance.hq-administration.hq-administration-process');
    }

    public function check_id(AccountPayableHqAdministration $selected)
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
        $this->selected->master->status=1;
        $this->selected->master->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('finance-hq-administration.index');
    }
}
