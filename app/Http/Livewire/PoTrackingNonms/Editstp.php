<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonmsStp;
use Auth;


class Editstp extends Component
{
    public $data;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
                                                   
           
        $data = $this->data;

        // return view('livewire.po-tracking-nonms.edit-stp')->with(['data'=>$data->paginate(50)]);
        return view('livewire.po-tracking-nonms.edit-stp');
        
    }


    public function mount($id)
    {
        $this->data             = PoTrackingNonmsStp::where('id_po_nonms_master', $id)->get();  
        
        
    }

    
}
