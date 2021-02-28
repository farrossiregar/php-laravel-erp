<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingReimbursement;
use Livewire\WithPagination;
use Auth;


class Editreimbursement extends Component
{

    public $month, $region;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit-esar') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }

        // $data           = PoTrackingReimbursement::where('id_po_tracking_master', $this->id);
         
        // if($this->month) $ata = $data->whereMonth('publish_date',$this->month);
        // if($this->region) $ata = $data->where('bidding_area',$this->region);

        $data = $this->data;
        
        return view('livewire.po-tracking.edit-reimbursement')->with(['data'=>$data->paginate(50)]);
        
        // return view('livewire.po-tracking.edit-reimbursement')->with(compact('data'));
        // return view('livewire.po-tracking.edit-reimbursement');
    }


    public function mount($id)
    {
        $this->id            = $id;
        // $this->data             = PoTrackingReimbursement::where('id_po_tracking_master', $id)->get();  
        
        $this->data           = PoTrackingReimbursement::where('id_po_tracking_master', $this->id);
         
        if($this->month) $ata = $data->whereMonth('publish_date',$this->month);
        if($this->region) $ata = $data->where('bidding_area',$this->region);
        
        
        
    }


}
