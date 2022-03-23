<?php

namespace App\Http\Livewire\TicketingSystemComplain;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approve extends Component
{
    protected $listeners = [
        'modalapproveassetrequest'=>'modalapproveassetrequest',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.asset-database.approvereq');
    }

    public function modalapproveassetrequest($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve       = $this->selected_id;
        $data               = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
        $data->status       = '1';
        $data->note         = $this->note;
        
        $data->save();


        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryassetrequest'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();


        session()->flash('message-success',"Berhasil, Asset Request sudah diapprove!!!");
        
        return redirect()->route('asset-database.index');
    }
}
