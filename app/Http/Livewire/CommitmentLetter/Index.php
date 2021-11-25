<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use Session;


class Index extends Component
{
    use WithPagination;
    public $date, $employee_id, $site_id;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
       
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
      

        return view('livewire.commitment-letter.index');

        
    }


}



