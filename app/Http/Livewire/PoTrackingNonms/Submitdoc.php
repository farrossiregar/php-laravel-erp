<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Submitdoc extends Component
{
    protected $listeners = [
        'modalsubmitdocpononms'=>'datasubmitdoc',
    ];

    use WithFileUploads;
    public $po_no;
    public $selected_id;
    public $status;

    public function render()
    {

        return view('livewire.po-tracking-nonms.submitdoc');
    }

    public function datasubmitdoc($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $status = $this->status;
        $user = \Auth::user();

        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();
        
        if($data->type_doc == '1'){
            $typedoc = 'STP';
            $cekprofit = \App\Models\PoTrackingNonmsStp::where('id_po_nonms_master', $this->selected_id)
                                                        ->where('profit', '<', '30')
                                                        ->get();

            if(count($cekprofit) > 0){ // submit to PMG
                $target_user = 'PMG';
                $target_user_access_id = '24';

                $data->status = '3';
                $data->save();
            }else{ // submit to Finance
                $target_user = 'Finance';
                $target_user_access_id = '2';

                $data->status = '1';
                $data->save();
            }
        }else{
            $typedoc = 'BOQ';
            $cekprofit = \App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master', $this->selected_id)
                                                        ->where('profit', '<', '30')
                                                        ->get();

            if(count($cekprofit) > 0){ // submit to PMG
                $target_user = 'PMG';
                $target_user_access_id = '24';

                $data->status = '3';
                $data->save();
            }else{ // submit to Finance
                $target_user = 'Finance';
                $target_user_access_id = '2';

                $data->status = '1';
                $data->save();
            }
        }

        $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', $target_user_access_id)->get();
        
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif_user as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
            $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        $notif_user_e2e = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '20')->get();
        
        $nameusere2e = [];
        $emailusere2e = [];
        $phoneusere2e = [];
        foreach($notif_user_e2e as $no => $itemusere2e){
            $nameusere2e[$no] = $itemusere2e->name;
            $emailusere2e[$no] = $itemusere2e->email;
            $phoneusere2e[$no] = $itemusere2e->telepon;

            $message = "*Dear User E2E - ".$nameusere2e[$no]."*\n\n";
            $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneusere2e[$no],'message'=>$message]);    

            // \Mail::to($emailusere2e[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        if($target_user == 'Finance'){
            $notif_user_finance_regional = DB::table('pmt.employees as employees')
                                                ->where('employees.user_access_id', '23') // Finance Regional
                                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                                ->get();

            $nameuser = [];
            $emailuser = [];
            $phoneuser = [];
            foreach($notif_user_finance_regional as $no => $itemuserfinance){
                $nameuser[$no] = $itemuserfinance->name;
                $emailuser[$no] = $itemuserfinance->email;
                $phoneuser[$no] = $itemuserfinance->telepon;
    
                $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
                $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
                send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    
    
                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }
        }

        session()->flash('message-success',"Success!, PO Tracking Non MS Submitted to ".$target_user);
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
