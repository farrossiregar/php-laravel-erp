<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importresourcebudget extends Component
{

    protected $listeners = [
        'modalimportresourcebudget'=>'importresourcebudget',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.contract-registration-flow.importresourcebudget');
        
    }

    public function importresourcebudget($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $resourcebudget = 'crf-resourcebudget'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/contract_registration_flow/Resource_budget/',$resourcebudget);

            $data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
            $data->ca_resource_budget         = $resourcebudget;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Resource Budget for Contract Registration Flow success");
        
        return redirect()->route('contract-registration-flow.index');

    }
    
}
