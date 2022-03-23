<?php

namespace App\Http\Livewire\AssetTransferRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Decline extends Component
{
    protected $listeners = [
        'modaldeclineassetrequest'=>'declineassetrequest',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.asset-transfer-request.decline');
    }

    public function declineassetrequest($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
        $data = \App\Models\AssetTransferRequest::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Decline </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Berhasil, Asset Transfer Request is Decline !!!");

        // \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('asset-transfer-request.index');
    }
}
