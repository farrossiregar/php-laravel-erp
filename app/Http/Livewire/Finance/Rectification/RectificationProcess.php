<?php

namespace App\Http\Livewire\Finance\Rectification;

use Livewire\Component;
use App\Models\AccountPayableRectification;

class RectificationProcess extends Component
{
    public $note,$selected;
    public $is_apstaff=false,$is_finance=false, $is_pmg=false;

    protected $listeners = ['check_id'];
    public function render()
    {
        $this->is_apstaff = true; //check_access('is-apstaff');
        $this->is_pmg = true; //check_access('is-pmg');
        $this->is_finance = check_access('is-finance');

        return view('livewire.finance.rectification.rectification-process');
    }

    public function check_id(AccountPayableRectification $selected)
    {
        $this->selected = $selected;
    }

    public function approve()
    {
        if($this->is_apstaff){
            $this->selected->status = 1; // approve by ap staff
        }else{
            $this->selected->status = 0; // approve by PMG
        }

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
        
        return redirect()->route('rectification.index');
    }
}
