<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Auth;
use Livewire\WithFileUploads;
use App\Models\ContractRegistrationFlow;

class Edit extends Component
{    
    use WithFileUploads;

    protected $listeners = [
        'modaledit'=>'edit',
    ];

    public $quotation_number, $po_number, $po_amount, $project_code, $sub_project_code, $start_contract, $end_contract, $selected_id, $data, $note, $remarks;
    public $file,$is_readonly;
    public function render()
    {
        return view('livewire.contract-registration-flow.edit');        
    }

    public function edit($id){
        
        $this->selected_id = $id;
        $this->data = ContractRegistrationFlow::find($id);
        $this->quotation_number     = @$this->data->quotation_number;
        $this->po_number            = @$this->data->po_number;
        $this->po_amount            = @$this->data->po_amount;
        $this->project_code         = @$this->data->project_code;
        $this->sub_project_code     = @$this->data->sub_project_code;
        $this->start_contract       = @$this->data->start_contract;
        $this->end_contract         = @$this->data->end_contract;
        $this->remarks                 = @$this->data->remarks;
        if($this->data->is_submit_contract==1) $this->is_readonly ="readonly";
    }
  
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);
        
        $data                           = ContractRegistrationFlow::where('id', $this->selected_id)->first();
        $data->po_amount                = $this->po_amount;
        $data->project_code             = $this->project_code;
        $data->sub_project_code         = $this->sub_project_code;
        $data->start_contract           = $this->start_contract;
        $data->end_contract             = $this->end_contract;
        $data->remarks                     = $this->remarks;
        $data->contract_duration        = $this->duration($this->start_contract, $this->end_contract);
        $data->is_submit_contract = 1;
        
        if($this->file){
            $contract = 'crf-contract'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/contract_registration_flow/Contract/',$contract);
            $data->contract = $contract;
        }
        
        $data->save();
        
        session()->flash('message-success',"Contract Registration Flow Berhasil diupdate");
        
        return redirect()->route('business-opportunities.index');
    }

    public function duration($start_time, $end_time)
    {    
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

        $waktu = '';
        if($months > 0){
            $waktu .= $months.' month ';
        }else{
            $waktu .= '';
        }

        if($days > 0){
            $waktu .= $days.' days';
        }else{
            $waktu .= '';
        }
        return $waktu;
    }
}