<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsStp;
use App\Models\PoTrackingNonmsBoq;
use Auth;
use DB;


class Editbast extends Component
{
    public $data, $id_master, $extra_budget;
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

        if($this->data[0]->type_doc == '1'){
            $data_doc = PoTrackingNonmsStp::where('id_po_nonms_master', $id);
        }else{
            $data_doc = PoTrackingNonmsBoq::where('id_po_nonms_master', $id);
        }
        $this->total_before     = $data_doc->select(DB::raw("SUM(price) as price"))    
                                            ->groupBy('id_po_nonms_master')  
                                            ->get();  

        $this->total_after      = $data_doc->select(DB::raw("SUM(input_price) as input_price"))    
                                            ->groupBy('id_po_nonms_master')  
                                            ->get(); 
        
        $total_before = json_decode($this->total_before);
        $total_before = $total_before[0]->price;
        $total_after = json_decode($this->total_after);
        $total_after = $total_after[0]->input_price;

        $this->extra_budget = $total_before - $total_after;
        
        $this->id = $id;
        $this->id_master = $id;
        
    }

    
}
