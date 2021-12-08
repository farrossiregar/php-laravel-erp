<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
class Index extends Component
{
    
    public function render()
    {
        if(!check_access('work-flow-management.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.work-flow-management.index');
    }

    public function mount()
    {
        \LogActivity::add('[web] WFM');
    }
    
}
