<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importtoolsbudget extends Component
{

    protected $listeners = [
        'modalimporttoolsbudget'=>'importtoolsbudget',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.contract-registration-flow.importtoolsbudget');
        
    }

    public function importtoolsbudget($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $toolsbudget = 'crf-toolsbudget'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/contract_registration_flow/Tools_budget/',$toolsbudget);

            $data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
            $data->ca_tools_budget         = $toolsbudget;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Tools Budget for Contract Registration Flow success");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('business-opportunities.index');
    }
    
}
