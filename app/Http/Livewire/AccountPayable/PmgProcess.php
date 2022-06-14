<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use App\Models\AccountPayable;

class PmgProcess extends Component
{
    protected $listeners = ['check_id'];
    public $selected,$note;
    public function render()
    {
        return view('livewire.account-payable.pmg-process');
    }

    public function check_id(AccountPayable $data)
    {
        $this->selected = $data;
    }

    public function approve()
    {
        $this->selected->status = 0; // approve
        $this->save();
    }

    public function reject()
    {
        $this->selected->status = 3; // reject
        $this->save();
    }

    public function save()
    {
        $this->selected->pmg_note = $this->note;
        $this->selected->save();

        session()->flash('message-success',__('Data processed successfully'));
        
        return redirect()->route('account-payable.index');
    }
}
