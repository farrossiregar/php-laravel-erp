<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvalhistory extends Component
{
    protected $listeners = [
        'modalapprovalhistoryteamschedule'=>'approvalhistoryteamschedule',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.team-schedule.approvalhistory');
    }

    public function approvalhistoryteamschedule($id)
    {
        $this->selected_id = $id;
        // dd(\App\Models\LogActivity::select('var')->where('subject', 'Approvalhistoryteamschedule'.$this->selected_id)->orderBy('id', 'desc')->get());
    }

  
}
