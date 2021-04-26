<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Submittofin extends Component
{
    protected $listeners = [
        'modalsubmittofin'=>'datasubmittofin',
    ];

    use WithFileUploads;
    public $po_no;
    public $selected_id;
    public $status;

    public function render()
    {

        return view('livewire.po-tracking-nonms.submittofin');
    }

    public function datasubmittofin($id)
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
            $data_detail = \App\Models\PoTrackingNonmsStp::where('id_po_nonms_master', $this->selected_id);
        }else{
            $typedoc = 'Ericson';
            $data_detail = \App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master', $this->selected_id);
        }   

        $total_before     = $data_detail->select(DB::raw("SUM(price) as price"))    
                                        ->groupBy('id_po_nonms_master')  
                                        ->get();  

        $total_after      = $data_detail->select(DB::raw("SUM(input_price) as input_price"))    
                                        ->groupBy('id_po_nonms_master')  
                                        ->get();  

        $total_before = json_decode($total_before);
        $total_before = $total_before[0]->price;
        $total_after = json_decode($total_after);
        $total_after = $total_after[0]->input_price;

        $extra_budget = $total_before - $total_after;

        if($extra_budget > 0){
            $data->acc_doc = '0';
        }

        $data->e2e_to_fin = '1';
        
        $data->save();
        
        $target_user = 'Finance';

        $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                                ->where('employees.user_access_id', '2')->get();
        
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

        session()->flash('message-success',"Success!, PO Tracking Non MS Submit E2E Bast to ".$target_user);
        
        return redirect()->route('po-tracking-nonms.edit-bast',['id'=>$data->id]);
    }
}
