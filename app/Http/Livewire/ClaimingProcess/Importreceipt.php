<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importreceipt extends Component
{

    protected $listeners = [
        'modalimportreceipt'=>'modalimportreceipt',
    ];

    use WithFileUploads;
    public $file, $selected_id, $data;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.claiming-process.importreceipt');
        
    }

    public function modalimportreceipt($id)
    {
        $this->selected_id = $id;
        
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            // $no                       = count(\App\Models\PettyCashUploader::where('id_petty_cash', $this->selected_id)->get()) + 1;
            $transferreceipt = 'claim-transferreq'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/ClaimingProcess/',$transferreceipt);

            $datauploader                       = \App\Models\ClaimingProcess::where('ticket_id', $this->selected_id)->first();
            $datauploader->transfer_receipt     = $transferreceipt;
            $datauploader->save();

        }

        session()->flash('message-success',"Upload Transfer Receipt success");
        
        
        return redirect()->route('claiming-process.index');

    }

    public function delete($id)
    {
        $check = \App\Models\PettyCashUploader::where('id',$id)->delete();
        
        return redirect()->route('petty-cash.index');
    }
    
}
