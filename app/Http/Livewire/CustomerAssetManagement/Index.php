<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;

class Index extends Component
{
    public $project_id;
    protected $queryString = ['project_id'];

    public function render()
    {
        if(!check_access('customer-asset-management.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.customer-asset-management.index');
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);

        \LogActivity::add('[web] Customer Asset Management');
    }
}
