<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;

class Index extends Component
{
    public $is_regional,$is_hq_user,$is_hq_ga;
    public function render()
    {
        // if(!$this->is_regional and !$this->is_hq_user and !$this->is_hq_ga) {
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        return view('livewire.asset-request.index');
    }

    public function mount()
    {
        $this->is_regional = check_access('is-regional');
        $this->is_hq_user = check_access('is-hq-user');
        $this->is_hq_ga = check_access('is-hq-ga');
    }
}
