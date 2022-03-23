<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historiinitehs extends Component
{    
    // protected $listeners = [
    //     'modalcriteriaehs'=>'criteriaehs',
    // ];
    public $selected_id, $date, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14, $value15;
    public $value, $service_type7;

    public function render()
    { 
        return view('livewire.vendor-management.historiinitehs');        
    }


    public function mount()
    {
        
        $this->value1 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->value;
        $this->value2 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->value;
        $this->value3 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->value;
        $this->value4 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->value;
        $this->value5 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->value;
        $this->value6 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->value;
        $this->value7 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->value;
        $this->value8 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->value;
        $this->value9 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->value;
        $this->value10 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->value;
        $this->value11 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->value;
        $this->value12 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->value;
        $this->value13 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->value;
        $this->value14 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->value;
        $this->value15 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '15')->first()->value;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        // $datavm = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id);

        $this->service_type7 = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->id_detail_title;
    }
  
    public function save()
    {
        $user = \Auth::user();
       
        for($i = 1; $i < 16; $i++){
            $data                                       = \App\Models\VendorManagementehsinit::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            if($i == 7){
                $data->id_detail_title                      = $this->service_type7;
            }
            
            $data->value                                 = $this->valueconcat('value', $i);
            $data->save();
        }

        $updatescoring                = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $updatescoring->initial       = $updatescoring->initial - ($updatescoring->initial_ehs_quality_management * 0.2);                      
        $updatescoring->save(); 

        

        $update                             = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $update->initial_ehs_company_structure      = ($this->value1 == 1 ? 10 : 0);
        $update->initial_ehs_project_management     = ($this->value2 == 1 ? 10 : 0);
        $update->initial_ehs_qualitymanagement      = ($this->value3 == 1 ? 5 : 0);
        $update->initial_ehs_training               = ($this->value4 == 1 ? 5 : 0);
        $update->initial_ehs_reporting              = ($this->value5 == 1 ? 10 : 0);
        $update->initial_ehs_documentation          = ($this->value6 == 1 ? 10 : 0);

        $value8 = (($this->value8) ? 10 : 0);
        $value9 = (($this->value9) ? 10 : 0);
        $value10 = (($this->value10) ? 10 : 0);
        $value11 = (($this->value11) ? 5 : 0);
        $value12 = (($this->value12) ? 5 : 0);
        $value13 = (($this->value13) ? 5 : 0);
        $value14 = (($this->value14) ? 5 : 0);

        $update->initial_ehs_certificate            = $value8 + $value9 + $value10 + $value11 + $value12 + $value13 + $value14;

        $update->initial_ehs_quality_management =  $update->initial_ehs_company_structure + $update->initial_ehs_project_management + $update->initial_ehs_qualitymanagement + $update->initial_ehs_training + $update->initial_ehs_reporting + $update->initial_ehs_documentation + $update->initial_ehs_certificate;

        $update->initial = $update->initial + ($update->initial_ehs_quality_management * 0.2);
        $update->save();


        session()->flash('message-success',"Criteria EHS & Quality Management Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.historiinitehs');  
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementehsinit::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        
        $check->save();

        session()->flash('message-success',"Initial EHS & Quality Management Successfully Evaluate!!!");
        return view('livewire.vendor-management.historiinitehs');  
        
    }

    public function valueconcat($field, $i){
        $fields = $field.$i;
        return $this->$fields;
    }

    public function duration($start_time, $end_time){
        
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