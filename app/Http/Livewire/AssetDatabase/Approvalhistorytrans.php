<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvalhistorytrans extends Component
{
    protected $listeners = [
        'modalapprovalhistoryassettrans'=>'modalapprovalhistoryassettrans',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.asset-database.approvalhistorytrans');
    }

    public function modalapprovalhistoryassettrans($id)
    {
        $this->selected_id = $id;
        // dd($id);
    }

  
}
