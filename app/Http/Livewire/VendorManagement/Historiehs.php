<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historiehs extends Component
{    
    // protected $listeners = [
    //     'modalcriteriaehs'=>'criteriaehs',
    // ];
    public $selected_id, $date, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14, $value15;

    public function render()
    {
        return view('livewire.vendor-management.historiehs');        
    }

    // public function criteriaehs($id)
    // {
    //     $this->selected_id = $id;
        
    //     $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        
    //     $this->general_information                  = $this->data->general_information;
    //     $this->team_availability_capability         = $this->data->team_availability_capability;
    //     $this->tools_facilities                     = $this->data->tools_facilities;
    //     $this->ehs_quality_management               = $this->data->ehs_quality_management;
    //     $this->commercial_compliance                = $this->data->commercial_compliance;
        
        
    // }

    // public function mount($id)
    // {
    //     $this->selected_id = $id;
        
    //     $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
    //     $datavm = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id);

        
    // }
  
    public function save()
    {
        $user = \Auth::user();
       

        $check                                       = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->first();
        if(!$check){ 
            for($i = 1; $i < 16; $i++){
                $data                                       = new \App\Models\VendorManagementehs();
                $data->id_supplier                          = $this->selected_id;
                $data->id_detail                            = $i;
                // $data->id_detail_title                      = $this->valueconcat('service_type', $i);
                $data->value                                 = $this->valueconcat('value', $i);
                $data->save();
            }
        }

        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $update->ehs_company_structure = '';
        $update->ehs_company_structure = '';
        $update->ehs_project_management = '';
        $update->ehs_qualitymanagement = '';
        $update->ehs_training = '';
        $update->ehs_reporting = '';
        $update->ehs_documentation = '';
        $update->ehs_certificate = '';
        $update->save();


        session()->flash('message-success',"Criteria EHS & Quality Management Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.criteriaehs');  
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementehs::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Criteria EHS & Quality Management Successfully Evaluate!!!");
        return view('livewire.vendor-management.criteriaehs');  
        
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