<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Submitfinreg extends Component
{
    protected $listeners = [
        'modalsubmitfinreg'=>'datafinreg',
    ];

    use WithFileUploads;
    public $po_no;
    public $selected_id;
    public $status;

    public function render()
    {

        return view('livewire.po-tracking-nonms.submitfinreg');
    }

    public function datafinreg($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $status = $this->status;
        $user = \Auth::user();

        $updatedata = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();
        $updatedata->status = '4';
        $updatedata->save();
        
        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();
        // $data->po_no = $this->po_no;

        if($data->type_doc == '1'){
            $typedoc = 'STP';
        }else{
            $typedoc = 'Ericson';
        }
        
        // if(count($cekprofit) > 0){ // submit to PMG
        //     $target_user = 'PMG';
        //     $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
        //                     ->where('employees.user_access_id', '22')->get();
        // }else{ // submit to Finance
        //     $target_user = 'Finance';
        //     $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
        //                     ->where('employees.user_access_id', '2')->get();
        // }

        

        // // $region_pono = \App\Models\PoTrackingReimbursement::where('po_no', $this->selected_id)->take(1)->get();

        // // $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
        // //                     ->where('employees.user_access_id', '22')
        // //                     ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', '=', 'employees.region_id')
        // //                     ->where('region.region_code', $region_pono[0]->bidding_area)->get();
        

        // $nameuser = [];
        // $emailuser = [];
        // $phoneuser = [];
        // foreach($notif_user as $no => $itemuser){
        //     $nameuser[$no] = $itemuser->name;
        //     $emailuser[$no] = $itemuser->email;
        //     $phoneuser[$no] = $itemuser->telepon;

        //     $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
        //     $message .= "*PO Tracking Non MS status = ".$status_text." pada ".date('d M Y H:i:s')."*\n\n";
        //     send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


        $notif_user_finance_regional = check_access_data('po-tracking-nonms.notif-finance-regional', $data->region);

        $target_user = "Finance Regional";
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif_user_finance_regional as $no => $itemuserfinance){
            $nameuser[$no] = $itemuserfinance->name;
            $emailuser[$no] = $itemuserfinance->email;
            $phoneuser[$no] = $itemuserfinance->telepon;

            $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
            $message .= "*Budget Transfer untuk PO Tracking Non MS ".$typedoc." ".$data->no_tt." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Success!, Budget for PO Tracking Non MS has been Succeed Transfered to ".$target_user." ".$data->region);
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
