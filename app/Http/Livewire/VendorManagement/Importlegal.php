<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importlegal extends Component
{

    protected $listeners = [
        'modalimportlegal'=>'importlegal',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.vendor-management.importlegal');
        
    }

    public function importlegal($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $legal = 'vm-legal'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Vendor_Management/Legal/',$legal);

            $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
            $data->legal         = $legal;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Legal for Vendor Management success");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('vendor-management.index');

    }
    
}
