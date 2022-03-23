<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;
use App\Models\PoTrackingReimbursementBastupload;
use App\Models\Region;
use App\Models\User;
use App\Models\UserEpl;
use DB;


class Editbast extends Component
{

    public $data;
    public $status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    


    public function render()
    {

        $user = User::all();
        // dd($user);

        // dd(\Auth::user());
        // if(check_access_controller('po-tracking.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
        
        // $data = PoTrackingReimbursementEsarupload::where('po_tracking_reimbursement_esarupload.id_po_tracking_master', $this->id)
        //                                                             ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
        //                                                             ->groupBy('po_tracking_reimbursement.po_no');
        //                                                             // ->get();  
        // // $data           = $this->data;
        // if($this->status){
        //     if($this->status == '1'){
        //         $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '!=', '');
        //     }else{
        //         $ata = $data->where('po_tracking_reimbursement_esarupload.approved_esar_filename', '');
        //     }   
        // }else{
        //     $data;
        // }
        
        
        
        
        // return view('livewire.po-tracking.edit-bast')->with(['data'=>$data->paginate(50)]);
        return view('livewire.po-tracking.edit-bast');
    }


    public function mount($id)
    {
        $user = \Auth::user();

        if($user->user_access_id == '22'){
            $region_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '22')
                                ->join(env('DB_DATABASE').'.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('employees.user_id', $user->id)->get();
               
                                
            $this->data             = DB::table('pmt.po_tracking_reimbursement as po_tracking_reimbursement')
                                            // ->select('po_tracking_reimbursement.po_no', 'po_tracking_reimbursement.bidding_area', 'po_tracking_reimbursement_bastupload.bast_uploader_userid', 'po_tracking_reimbursement_bastupload.bast_filename', 'po_tracking_reimbursement_bastupload.status')
                                            ->leftjoin(env('DB_DATABASE').'.po_tracking_reimbursement_bastupload as po_tracking_reimbursement_bastupload', 'po_tracking_reimbursement.po_no', '=', 'po_tracking_reimbursement_bastupload.po_no')
                                            ->join(env('DB_DATABASE').'.region as region', 'region.region_code', '=', 'po_tracking_reimbursement.bidding_area')
                                            ->where('po_tracking_reimbursement.id_po_tracking_master', $id)
                                            ->where('po_tracking_reimbursement.bidding_area', $region_user[0]->region_code)
                                            ->groupBy('po_tracking_reimbursement.po_no')
                                            ->get();

            // $this->data             = PoTrackingReimbursement::where('po_tracking_reimbursement.id_po_tracking_master', $id)
            //                                                         ->where('po_tracking_reimbursement.bidding_area', 'Jabo')
            //                                                         ->leftjoin('po_tracking_reimbursement_bastupload', 'po_tracking_reimbursement.po_no', '=', 'po_tracking_reimbursement_bastupload.po_no')
            //                                                         // ->join('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_esarupload.id_po_tracking_master')
            //                                                         ->groupBy('po_tracking_reimbursement.po_no')
            //                                                         ->get();  
        }else{
            // $this->data             = PoTrackingReimbursementBastupload::where('po_tracking_reimbursement_bastupload.id_po_tracking_master', $id)
            //                                                         ->leftjoin('po_tracking_reimbursement', 'po_tracking_reimbursement.id_po_tracking_master', '=', 'po_tracking_reimbursement_bastupload.id_po_tracking_master')
            //                                                         ->groupBy('po_tracking_reimbursement.po_no')
            //                                                         ->get();  

            $this->data             = DB::table(env('DB_DATABASE').'.po_tracking_reimbursement as po_tracking_reimbursement')
                                                // ->select('po_tracking_reimbursement.po_no', 'po_tracking_reimbursement.bidding_area', 'po_tracking_reimbursement_bastupload.bast_uploader_userid', 'po_tracking_reimbursement_bastupload.bast_filename', 'po_tracking_reimbursement_bastupload.status')
                                                ->leftjoin(env('DB_DATABASE').'.po_tracking_reimbursement_bastupload as po_tracking_reimbursement_bastupload', 'po_tracking_reimbursement.po_no', '=', 'po_tracking_reimbursement_bastupload.po_no')
                                                ->where('po_tracking_reimbursement.id_po_tracking_master', $id)
                                                ->groupBy('po_tracking_reimbursement.po_no')
                                                ->get(); 
            
        }
        

        $this->id = $id;
        
        
        
    }

    
}
