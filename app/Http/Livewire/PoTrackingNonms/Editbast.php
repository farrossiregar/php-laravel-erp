<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Editbast extends Component
{
    public $data, $id_master;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
                                                   
           
        $data = $this->data;

        $id_master = $this->id;
        
        return view('livewire.po-tracking-nonms.edit-bast');
        
    }


    public function mount($id)
    {
        $this->data             = PoTrackingNonms::where('id', $id)->get();  
        
        
        $this->id = $id;
        $this->id_master = $id;
        
    }

    
}
