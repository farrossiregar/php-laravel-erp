<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Index extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
    //     if(!check_access('po-tracking-nonms.index')){
    //         session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
    //         $this->redirect('/');
    //     }

     
        
        return view('livewire.dana-stpl.index');
        
        
    }


}



