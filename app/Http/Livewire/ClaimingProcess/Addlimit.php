<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;

use Session;

class Addlimit extends Component
{

    use WithFileUploads;
    public $selected_id, $data;
    public $claim_category, $user_access, $limit, $year;


    
    public function render()
    {

        return view('livewire.claiming-process.addlimit');
        
    }

  
    public function save()
    {
        $data                           = new \App\Models\ClaimingProcessLimit();
       
        $data->claim_category           = $this->claim_category;
        $data->user_access              = $this->user_access;
        $data->limit                    = $this->limit;
        $data->year                     = $this->year;
        
      
        $data->save();
        
        session()->flash('message-success',"Claim Limit Berhasil ditambahkan");
        
        return redirect()->route('claiming-process.index');
        
    }

    
}
