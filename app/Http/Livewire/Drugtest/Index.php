<?php

namespace App\Http\Livewire\Drugtest;

use Livewire\Component;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $project_id;
    protected $queryString = ['project_id'];

    public function render()
    {
        if(!check_access('drug-test.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        return view('livewire.drugtest.index');
    }

    public function mount()
    {
        \LogActivity::add('[web] Drug Test');

        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
    }
}
