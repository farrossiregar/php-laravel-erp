<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importrevenue extends Component
{

    protected $listeners = [
        'modalimportrevenue'=>'importrevenue',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.contract-registration-flow.importrevenue');
        
    }

    public function importrevenue($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $revenue = 'crf-revenue'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/contract_registration_flow/Revenue/',$revenue);

            $data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
            $data->revenue         = $revenue;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Revenue for Contract Registration Flow success");
        
        return redirect()->route('contract-registration-flow.index');

    }
    
}
