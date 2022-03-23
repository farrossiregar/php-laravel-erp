<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvenoc extends Component
{
    protected $listeners = [
        'modalapprovedatabasenoc'=>'approvenoc',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.database-tools-noc.approvenoc');
    }

    public function approvenoc($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\EmployeeNoc::where('id', $this->selected_id)->first();
        $data->status = '1';
        
        $data->save();

    
        $notif_user_psm = check_access_data('database-noc.notif-psm', '');
        $nameuser_psm = [];
        $emailuser_psm = [];
        $phoneuser_psm = [];
        foreach($notif_user_psm as $no => $itemuser){
            $nameuser_psm[$no] = $itemuser->name;
            $emailuser_psm[$no] = $itemuser->email;
            $phoneuser_psm[$no] = $itemuser->telepon;

            $message = "*Dear PSM *\n\n";
            $message .= "*Database NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
            send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        $notif_user_hr = check_access_data('database-noc.notif-hr', '');
        $nameuser_hr = [];
        $emailuser_hr = [];
        $phoneuser_hr = [];
        foreach($notif_user_hr as $no => $itemuser){
            $nameuser_hr[$no] = $itemuser->name;
            $emailuser_hr[$no] = $itemuser->email;
            $phoneuser_hr[$no] = $itemuser->telepon;

            $message = "*Dear HRD *\n\n";
            $message .= "*Database NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
            send_wa(['phone'=> $phoneuser_hr[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Berhasil, Database NOC sudah diapprove!!!");
        
        return redirect()->route('database-tools-noc.index');
    }
}
