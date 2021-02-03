<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteListTrackingMaster;


class Index extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = SiteListTrackingMaster::orderBy('id', 'DESC');
        if(check_access_controller('site-tracking.index') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }

       

        return view('livewire.criticalcase.index')->with(['data'=>$data->paginate(100)]);
    }
}



