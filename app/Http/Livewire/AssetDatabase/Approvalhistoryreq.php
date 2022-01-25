<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvalhistoryreq extends Component
{
    protected $listeners = [
        'modalapprovalhistoryassetrequest'=>'approvalhistoryassetrequest',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.asset-database.approvalhistoryreq');
    }

    public function approvalhistoryassetrequest($id)
    {
        $this->selected_id = $id;
        // dd($id);
    }

  
}
