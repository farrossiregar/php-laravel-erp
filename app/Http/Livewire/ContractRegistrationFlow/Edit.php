<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Auth;

class Edit extends Component
{    
    protected $listeners = [
        'modaledit'=>'edit',
    ];

    public $quotation_number, $po_number, $po_amount, $project_code, $sub_project_code, $start_contract, $end_contract, $selected_id, $data, $note, $remarks;

    public function render()
    {

        return view('livewire.contract-registration-flow.edit');        
    }

   
    public function edit($id){
        
        $this->selected_id = $id;
        // dd($this->selected_id);
        $this->data = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
        // dd($this->data);
        $this->quotation_number     = @$this->data->quotation_number;
        $this->po_number            = @$this->data->po_number;
        $this->po_amount            = @$this->data->po_amount;
        $this->project_code         = @$this->data->project_code;
        $this->sub_project_code     = @$this->data->sub_project_code;
        $this->start_contract       = @$this->data->start_contract;
        $this->end_contract         = @$this->data->end_contract;
        $this->remarks                 = @$this->data->remarks;
    }
  
    public function save()
    {
        
        $data                           = \App\Models\ContractRegistrationFlow::where('id', $this->selected_id)->first();
        // dd($data);
        $data->po_amount                = $this->po_amount;
        $data->project_code             = $this->project_code;
        $data->sub_project_code         = $this->sub_project_code;
        $data->start_contract           = $this->start_contract;
        $data->end_contract             = $this->end_contract;
        $data->remarks                     = $this->remarks;
        $data->contract_duration        = $this->duration($this->start_contract, $this->end_contract);
        
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"Contract Registration Flow Berhasil diupdate");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('business-opportunities.index');
    }

    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        // if($hours > 0){
        //     $waktu = $hours.'.'.$minuts.' hours';
        //     // $waktu = $hours;
        // }else{
        //     $waktu = $minuts.' minute';
        //     // $waktu = $minuts;
        // }

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