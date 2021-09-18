<?php

namespace App\Http\Livewire\ApplicationRoomRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approveroomrequest extends Component
{
    protected $listeners = [
        'modalapproveroomrequest'=>'approveroomrequest',
    ];

    use WithFileUploads;
    public $selected_id;


    
    public function render()
    {
 
        return view('livewire.application-room-request.approveroomrequest');
    }

    public function approveroomrequest($id)
    {
        $this->selected_id = $id;
        // $data = \App\Models\ApplicationRoomRequest::where('id', $this->selected_id)->first();
        // $this->type_request = $data->type_request;
        
    }

  
    public function save()
    {
        $data = \App\Models\ApplicationRoomRequest::where('id', $this->selected_id)->first();
        if($data->type_request == 'Application'){    
            if(check_access('application-room-request.manager-approval')){
                $data->status = '1';
                $notif = check_access_data('application-room-request.notif-manager', '');
                $message = "*Dear PMG / IT *\n\n";
                $alert = "Berhasil, Pengajuan Application Access sudah diapprove dan menunggu approval PMG / IT !!!";
            }

            if(check_access('application-room-request.pmg-approval')){
                $data->status = '2';
                $notif = check_access_data('application-room-request.notif-user', '');
                $message = "*Dear User ".$data->employee_name."*\n\n";
                $alert = "Berhasil, Pengajuan Application Access sudah diapprove !!!";
            }
    
            $data->save();

            
            $nameuser = [];
            $emailuser = [];
            $phoneuser = [];
            foreach($notif as $no => $itemuser){
                $nameuser[$no] = $itemuser->name;
                $emailuser[$no] = $itemuser->email;
                $phoneuser[$no] = $itemuser->telepon;

                
                $message .= "*Pengajuan Application Access dengan id ".$this->selected_id." menunggu konfirmasi *\n\n";
                send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }

        
            session()->flash('message-success',$alert);

            return redirect()->route('application-room-request.index');
        }


        if($data->type_request == 'Room'){
            $data = \App\Models\ApplicationRoomRequest::where('id', $this->selected_id)->first();
        
            $data->status   = '2';

            $data->save();

            $notif = check_access_data('application-room-request.notif-user', '');
            $nameuser = [];
            $emailuser = [];
            $phoneuser = [];
            foreach($notif as $no => $itemuser){
                $nameuser[$no] = $itemuser->name;
                $emailuser[$no] = $itemuser->email;
                $phoneuser[$no] = $itemuser->telepon;

                $message = "*Dear User ".$nameuser."*\n\n";
                $message .= "*Pengajuan Room Access dengan id ".$this->selected_id." sudah diapprove *\n\n";
                send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }

            session()->flash('message-success',"Berhasil, Pengajuan Room Access is Approved !!!");
            
            return redirect()->route('application-room-request.index');
        }

        
    }
}
