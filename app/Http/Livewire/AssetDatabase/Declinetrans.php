<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Declinetrans extends Component
{
    protected $listeners = [
        'modaldeclineassettrans'=>'modaldeclineassettrans',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $note;

    
    public function render()
    {       
        return view('livewire.asset-database.declinetrans');
    }

    public function modaldeclineassettrans($id)
    {
        $this->selected_id = $id;
        // dd($id[0]);
    }

  
    public function save()
    {
        
        $data = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
        
        $data->status   = '0';
        $data->note     = $this->note;

        $data->save();

        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryassettransfer'.$this->selected_id;
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Decline </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Berhasil, Asset Request is Decline !!!");

        // \LogActivity::add('[web] Duty Roster - Home Base Input');
        
        return redirect()->route('asset-database.index');
    }
}
