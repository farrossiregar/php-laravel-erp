<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Inputapprovedamount extends Component
{
    protected $listeners = [
        'modalinputapprovedamount'=>'modalinputapprovedamount',
    ];

    use WithFileUploads;
    public $selected_id, $approved_amount;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.consumable-item-database.inputapprovedamount');
    }

    public function modalinputapprovedamount($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data                           = \App\Models\ConsumableItemRequest::where('id', $this->selected_id)->first();
        $data->approved_amount          = $this->approved_amount;
        $data->total_price              = $this->approved_amount * $data->price;
        
        
        $data->save();


        // $datahistory = new \App\Models\LogActivity();
        // $datahistory->subject = 'Approvalhistoryassetrequest'.$type_approve[0];
        // $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        // $datahistory->save();


        session()->flash('message-success',"Berhasil, Approved Amount berhasil diupdate!!!");
        
        return redirect()->route('consumable-item-database.index');
    }
}
