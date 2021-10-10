<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importteamdimension extends Component
{

    protected $listeners = [
        'modalimportteamdimension'=>'importteamdimension',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.contract-registration-flow.importteamdimension');
        
    }

    public function importteamdimension($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $teamdimension = 'crf-teamdimension'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/contract_registration_flow/Team_dimension/',$teamdimension);

            $data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
            $data->team_dimension         = $teamdimension;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Team Dimension for Contract Registration Flow success");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('business-opportunities.index');

    }
    
}
