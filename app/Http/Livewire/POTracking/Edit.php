<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;


class Edit extends Component
{

    public $data;
    public $status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
        
        $user = \Auth::user();

        if($user->user_access_id == '22'){
            $region_user = DB::table('pmt.employees as employees')
                                ->where('employees.user_access_id', '22')
                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('employees.user_id', $user->id)->get();
            $data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->where('po_tracking_reimbursement.bidding_area',  $region_user[0]->region_code)
                                                                    ->groupBy('po_tracking_reimbursement.po_no');
                                                                    
        }else{
            $data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement.po_no');
        }
        // $data           = $this->data;
        if($this->status){
            if($this->status == '1'){
                $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '!=', '');
            }else{
                $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '');
            }   
        }else{
            $data;
        }
        

        return view('livewire.po-tracking.edit');
        // return view('livewire.po-tracking.edit')->with(compact('data'));
        // return view('livewire.po-tracking.index')->with(['data'=>$data->paginate(50)]);
    }


    public function mount($id)
    {
        if($user->user_access_id == '22'){
            $region_user = DB::table('pmt.employees as employees')
                                ->where('employees.user_access_id', '22')
                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('employees.user_id', $user->id)->get();
            $this->data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->where('po_tracking_reimbursement.bidding_area',  $region_user[0]->region_code)
                                                                    ->groupBy('po_tracking_reimbursement.po_no')
                                                                    ->get();
                                                                    
        }else{
            $this->data             = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $id)
                                                                    ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
                                                                    ->groupBy('po_tracking_reimbursement.po_no')
                                                                    ->get();  
        }

        dd($this->data);
        

        $this->id = $id;
        
        
        
    }

    
}
