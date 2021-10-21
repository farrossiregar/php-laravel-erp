<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importcertificationresource extends Component
{

    protected $listeners = [
        'modalimportcertificationresource'=>'importcertificationresource',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.vendor-management.importcertificationresource');
        
    }

    public function importcertificationresource($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $importcertificationresource = 'vm-certificationresource'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Vendor_Management/Certification_Resource/',$importcertificationresource);

            $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
            $data->certification_resource         = $importcertificationresource;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Certification of Resource for Vendor Management success");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('vendor-management.index');

    }
    
}
