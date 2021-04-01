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
                $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '24')->get();

                $data->status = '3';
                $data->save();
            }else{ // submit to Finance
                $target_user = 'Finance';
                $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '2')->get();

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
                $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '24')->get();

                $data->status = '3';
                $data->save();
            }else{ // submit to Finance
                $target_user = 'Finance';
                $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '2')->get();

                $data->status = '1';
                $data->save();
            }
        }
        
        
        $message = "*Dear ".$target_user." - Farros Siregar*\n\n";
        $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
        send_wa(['phone'=> '087871200923','message'=>$message]);
        
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

        session()->flash('message-success',"Success!, PO Tracking Non MS Submitted to ".$target_user);
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
