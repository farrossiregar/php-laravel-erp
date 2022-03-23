<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Uploadir extends Component
{

    protected $listeners = [
        'modaluploadir'=>'uploadir',
    ];

    use WithFileUploads;

    public $selected_id;
    public $file;
    public $data;

    
    public function render()
    {
        
        return view('livewire.dana-stpl.uploadir');
    }

    public function uploadir($id)
    {
        
        $this->selected_id = $id;
        $this->data = \App\Models\DanaStpl::select('uploadir')->where('id', $this->selected_id)->get(); 
        
    }
  
    public function upload()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf,jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ir = 'dana-stpl-ir'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Dana_Stpl/insiden_report/',$ir);

            $data = \App\Models\DanaStpl::where('id', $this->selected_id)->first();            
            $data->uploadir = $ir;
            $data->save();


            $msg = "*Insiden Report untuk Dana Stpl dengan id ".$this->selected_id." telah diupload*\n\n";


            $notif_user_sm = \App\Models\Employee::where('id', $data->sm_id)->get();   

            $nameuser_sm = [];
            $emailuser_sm = [];
            $phoneuser_sm = [];
            foreach($notif_user_sm as $no => $itemuser){
                $nameuser_sm[$no] = $itemuser->name;
                $emailuser_sm[$no] = $itemuser->email;
                $phoneuser_sm[$no] = $itemuser->telepon;

                $message = "*Dear Security Manager - ".$nameuser_sm[$no]."*\n\n";
                $message .= $msg;
                send_wa(['phone'=> $phoneuser_sm[$no],'message'=>$message]);    

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }
            

            $notif_user_ms = check_access_data('dana-stpl.approve-ms', '');

            $nameuser_ms = [];
            $emailuser_ms = [];
            $phoneuser_ms = [];
            foreach($notif_user_ms as $no => $itemuser){
                $nameuser_ms[$no] = $itemuser->name;
                $emailuser_ms[$no] = $itemuser->email;
                $phoneuser_ms[$no] = $itemuser->telepon;

                $message = "*Dear Manager Security - ".$nameuser_ms[$no]."*\n\n";
                $message .= $msg;
                send_wa(['phone'=> $phoneuser_ms[$no],'message'=>$message]);    

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }

            $notif_user_psm = check_access_data('dana-stpl.approve-psm', '');

            $nameuser_psm = [];
            $emailuser_psm = [];
            $phoneuser_psm = [];
            foreach($notif_user_psm as $no => $itemuser){
                $nameuser_psm[$no] = $itemuser->name;
                $emailuser_psm[$no] = $itemuser->email;
                $phoneuser_psm[$no] = $itemuser->telepon;

                $message = "*Dear PSM - ".$nameuser_psm[$no]."*\n\n";
                $message .= $msg;
                send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }
        }


        
      

        session()->flash('message-success',"Insiden Report Berhasil diupload");
        
        return redirect()->route('dana-stpl.index');
    }

   
}
