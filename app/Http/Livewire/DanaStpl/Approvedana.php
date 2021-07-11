<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedana extends Component
{
    protected $listeners = [
        'modalapprovedana'=>'approvedana',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.dana-stpl.approvestpl');
    }

    public function approvedana($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data = \App\Models\DanaStpl::where('id', $this->selected_id)->first();
        
        if($this->usertype == 'sm'){
            $data->status   = '1';
        }elseif($this->usertype == 'ms'){
            $data->status   = '2';
        }else{
            $data->status   = '3';
        }
        
        // dd($this->usertype);

        $data->save();

        session()->flash('message-success',"Berhasil, Dana sudah diapprove!!!");
        
        return redirect()->route('dana-stpl.index');
    }
}
