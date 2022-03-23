<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvalhistory extends Component
{
    protected $listeners = [
        'modalapprovalhistorypettycash'=>'approvalhistorypettycash',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.petty-cash.approvalhistory');
    }

    public function approvalhistorypettycash($id)
    {
        $this->selected_id = $id;
        // dd($id);
    }

  
}
