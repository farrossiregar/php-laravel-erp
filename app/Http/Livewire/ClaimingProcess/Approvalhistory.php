<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvalhistory extends Component
{
    protected $listeners = [
        'modalapprovalhistoryclaimingprocess'=>'modalapprovalhistoryclaimingprocess',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.claiming-process.approvalhistory');
    }

    public function modalapprovalhistoryclaimingprocess($id)
    {
        $this->selected_id = $id;
        
    }

  
}
