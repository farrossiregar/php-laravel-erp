<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvebast extends Component
{
    protected $listeners = [
        'modal-approvebast'=>'dataapprovebast',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;
    public $status;

    public function render()
    {

        

        return view('livewire.po-tracking.approvebast');
    }

    public function dataapprovebast($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $status = $this->status;
        $user = \Auth::user();

        $data = \App\Models\PoTrackingReimbursementBastupload::where('po_no', $this->selected_id)->first();
        $data->bast_uploader_userid = $user->id;
        if($status == '1'){
            $status_text = 'Approved';
            $status_type = 'success';
            $data->status = $status;
        }else{
            $data->bast_filename = '';
            $status_text = 'Rejected';
            $status_type = 'danger';
            $data->status = $status;
        }

        $data->save();

        $region_pono = \App\Models\PoTrackingReimbursement::where('po_no', $this->selected_id)->take(1)->get();
        
        // $notif_user = \App\Models\Employee::where('employee.user_access_id', '22')
        //                                     ->join('region', 'region.id', '=', 'employee.region_id')
        //                                     ->where('region.region_code', $region_pono[0]->bidding_area)->get();

        $notif_user = DB::table(env('DB_DATABASE').'.employees as employees')
                            ->where('employees.user_access_id', '22')
                            ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', '=', 'employees.region_id')
                            ->where('region.region_code', $region_pono[0]->bidding_area)->get();
        

        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif_user as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear Operation Region ".$region_pono[0]->bidding_area." - ".$nameuser[$no]."*\n\n";
            $message .= "*Bast dengan PO No ".$this->selected_id." status = ".$status_text." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-'.$status_type,"Success!, Bast PO No ".$this->selected_id." is ".$status_text);
        
        return redirect()->route('po-tracking.index');
    }
}
