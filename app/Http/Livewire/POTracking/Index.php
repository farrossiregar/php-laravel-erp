<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingReimbursement;

class Index extends Component
{
    public $date;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = PoTrackingReimbursement::orderBy('id', 'DESC');

        if($this->date) $data = $data->whereDate('created_at',$this->date);

        return view('livewire.po-tracking.index')->with(['data'=>$data->paginate(50)]);
        
    }
}