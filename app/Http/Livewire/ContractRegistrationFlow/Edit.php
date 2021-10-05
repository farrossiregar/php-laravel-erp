<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Auth;

class Edit extends Component
{    
    protected $listeners = [
        'modaledit'=>'edit',
    ];

    public $po_amount, $project_code, $sub_project_code, $startdate, $enddate, $selected_id, $data;

    public function render()
    {

        return view('livewire.contract-registration-flow.edit');        
    }

   
    public function edit($id){
        
        $this->selected_id = $id;
        $this->data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
        
        $this->po_amount = $this->data->po_amount;
        $this->project_code = $this->data->project_code;
        $this->sub_project_code = $this->data->sub_project_code;
    }
  
    public function save()
    {
        
        $data                           = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
        $data->po_amount                = $this->po_amount;
        $data->project_code             = $this->project_code;
        $data->sub_project_code         = $this->sub_project_code;
        // $data->start_contract                 = 10;
        
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"Contract Registration Flow Berhasil diupdate");
        
        return redirect()->route('contract-registration-flow.index');
    }
}