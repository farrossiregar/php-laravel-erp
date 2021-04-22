<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use App\Models\PoTrackingReimbursement;
use Livewire\WithPagination;
use Auth;
use DB;


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
        $user = \Auth::user();

        if($user->user_access_id == '22'){
            $region_user = DB::table('pmt.employees as employees')
                                ->where('employees.user_access_id', '22')
                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('employees.user_id', $user->id)->get();
            $this->data           = PoTrackingReimbursement::where('id_po_tracking_master', $this->id)
                                                                ->where('bidding_area', $region_user[0]->region_code);
                                                                    
        }else{
            $this->data           = PoTrackingReimbursement::where('id_po_tracking_master', $this->id);
                                                            
        }
        
         
        // if($this->month) $data = $data->whereMonth('publish_date',$this->month);
        // if($this->region) $data = $data->where('bidding_area',$this->region);
        
        
        
    }


}
