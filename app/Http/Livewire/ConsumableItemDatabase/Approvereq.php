<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Approvereq extends Component
{
    protected $listeners = [
        'modalapproveconsumableitemdatabase'=>'modalapproveconsumableitemdatabase',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.consumable-item-database.approvereq');
    }

    public function modalapproveconsumableitemdatabase($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $type_approve                   = $this->selected_id;
        $data                           = \App\Models\ConsumableItemRequest::where('id', $type_approve[0])->first();
        $data->status                   = $type_approve[1];
        $data->release_dana_pettycash   = $data->total_price;
        $data->note                     = $this->note;
        
        $data->save();

        // dd($type_approve);
        if($type_approve[1] == '2'){
            $datapettycash                  = new \App\Models\HrgaPettyCash();
            $datapettycash->dana_release    = $data->total_price;
            $datapettycash->request_from    = 'ConsumableItemRequest';
            $datapettycash->id_modul        = $type_approve[0];
            
            $datapettycash->save();
        }

        $datahistory = new \App\Models\LogActivity();
        $datahistory->subject = 'Approvalhistoryassetrequest'.$type_approve[0];
        $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        $datahistory->save();


        session()->flash('message-success',"Berhasil, Item Request sudah diapprove!!!");
        
        return redirect()->route('consumable-item-database.index');
    }
}
