<?php

namespace App\Http\Livewire\AssetTransferRequest;

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
    public $selected_id;    
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
        
        
        $data->save();


        session()->flash('message-success',"Berhasil, Asset Request sudah diapprove!!!");
        
        return redirect()->route('asset-request.index');
    }
}
