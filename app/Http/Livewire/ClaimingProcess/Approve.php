<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveassetrequest'=>'approveassetrequest',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.asset-request.approve');
    }

    public function approveassetrequest($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve = $this->selected_id;
        $data = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        if($type_approve[1] == '1'){
            $data->status = '1';
        }else{
            $data->status = '2';
        }
        $data->note     = $this->note;
        
        $data->save();


        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryassetrequest'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();


        session()->flash('message-success',"Berhasil, Asset Request sudah diapprove!!!");
        
        return redirect()->route('asset-request.index');
    }
}
