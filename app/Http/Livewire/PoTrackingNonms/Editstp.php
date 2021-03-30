<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonmsStp;
use Auth;
use DB;


class Editstp extends Component
{
    public $data, $total_before, $total_after, $total_profit, $id_master;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
                                                   
           
        $data = $this->data;
        $total_before = json_decode($this->total_before);
        $total_before = $total_before[0]->price;
        $total_after = json_decode($this->total_after);
        $total_after = $total_after[0]->input_price;
        if($total_before && $total_after){
            $total_profit = 100 - round(($total_before / $total_after) * 100);
        }else{
            $total_profit = '100';
        }

        $id_master = $this->id;
        


        // return view('livewire.po-tracking-nonms.edit-stp')->with(['data'=>$data->paginate(50)]);
        return view('livewire.po-tracking-nonms.edit-stp');
        
    }


    public function mount($id)
    {
        $this->data             = PoTrackingNonmsStp::where('id_po_nonms_master', $id)->get();  
        
        $this->total_before = PoTrackingNonmsStp::where('id_po_nonms_master', $id)
                                                ->select(DB::raw("SUM(price) as price"))    
                                                ->groupBy('id_po_nonms_master')  
                                                ->get();  

        $this->total_after = PoTrackingNonmsStp::where('id_po_nonms_master', $id)
                                                ->select(DB::raw("SUM(input_price) as input_price"))    
                                                ->groupBy('id_po_nonms_master')  
                                                ->get();  
        
        $this->id = $id;
        
    }

    
}
