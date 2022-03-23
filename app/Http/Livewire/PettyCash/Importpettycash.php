<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importpettycash extends Component
{

    protected $listeners = [
        'modalimportpettycash'=>'importpettycash',
    ];

    use WithFileUploads;
    public $file, $selected_id, $data;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.petty-cash.importpettycash');
        
    }

    public function importpettycash($id)
    {
        $this->selected_id = $id;
        $this->data = \App\Models\PettyCashUploader::where('id_petty_cash', $this->selected_id)->get();
        // dd($this->data);
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $no                       = count(\App\Models\PettyCashUploader::where('id_petty_cash', $this->selected_id)->get()) + 1;
            $pettycash = 'petty-cash-settlement'.$this->selected_id.'('.$no.').'.$this->file->extension();
            $this->file->storePubliclyAs('public/PettyCash/',$pettycash);

            $datauploader                   = new \App\Models\PettyCashUploader();
            $datauploader->id_petty_cash    = $this->selected_id;
            $datauploader->settlement       = $pettycash;
            $datauploader->save();

        }

        session()->flash('message-success',"Upload Softcopy of Receipt success");
        
        
        return redirect()->route('petty-cash.index');

    }

    public function delete($id)
    {
        $check = \App\Models\PettyCashUploader::where('id',$id)->delete();
        
        return redirect()->route('petty-cash.index');
    }
    
}
