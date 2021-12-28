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
        return view('livewire.asset-transfer-request.approve');
    }

    public function approveassetrequest($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve = $this->selected_id;
        $data = \App\Models\AssetTransferRequest::where('id', $this->selected_id)->first();
        $data->status = '1';
        
        $data->save();


        session()->flash('message-success',"Berhasil, Asset Transfer Request sudah diapprove!!!");
        
        return redirect()->route('asset-transfer-request.index');
    }
}
