<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementBastupload;
use DB;

class Approvebast extends Component
{
    protected $listeners = [
        'modal-approvebast'=>'dataapprovebast',
    ];

    use WithFileUploads;
    public $file,$po,$status,$bast,$note;

    public function render()
    {        
        return view('livewire.po-tracking.approvebast');
    }

    public function dataapprovebast(PoTrackingReimbursement $id)
    {
        $this->po = $id;
        $this->bast = PoTrackingReimbursementBastupload::where('po_tracking_reimbursement_id', $this->po->id)->first();
    }

    public function approve()
    {
        $this->bast->status = 1;
        $this->po->status = 2;
        $this->po->note = $this->note;
        $this->save();
    }

    public function reject()
    {
        $this->validate([
            'note' => 'required'
        ]);
        $this->bast->status = 0;
        $this->po->status = 0;
        $this->po->is_revisi = 1;
        $this->po->note = $this->note;
        $this->save();
    }

    public function save()
    {
        $this->bast->bast_uploader_userid = \Auth::user()->id;
        $this->bast->save();

        $this->po->save();

        $region_pono = PoTrackingReimbursement::where('id', $this->po->id)->take(1)->get();
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
            $message .= "*Bast dengan PO No ".$this->po->po_reimbursement_id." status = ".($this->bast->status ==1?'Approved' : 'Reject')." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-'.($this->bast->status==1?'success':'alert'),"Success!, Bast PO No ".$this->po->po_reimbursement_id." is ".($this->bast->status ==1?'Approved' : 'Reject'));
        
        return redirect()->route('po-tracking.index');
    }
}
