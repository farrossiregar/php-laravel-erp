<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historiinitgeneralinformation extends Component
{    
    // protected $listeners = [
    //     'modalcriteriageneralinformation'=>'criteriageneralinformation',
    // ];
    
    public $date; 

    public $selected_id, $data, $datavm;
    public function render()
    {
        
        return view('livewire.vendor-management.historigeneralinformation');        
    }

  
    public function save()
    {
        
        $user = \Auth::user();
        
        // $check                                       = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->first();
        // if(!$check){ 
            for($i = 1; $i < 46; $i++){
                $data                                       = new \App\Models\VendorManagementgi();
                $data->id_supplier                          = $this->selected_id;
                $data->id_detail                            = $i;
                // $data->id_detail_title                      = $this->valueconcat('service_type', $i);
                $data->value                                 = $this->valueconcat('value', $i);
                $data->save();
            }

            
        // }
    
        
        
        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $checkktp                     = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', 2)->first();
        $checknpwp                    = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', 3)->first();

        

        if($checkktp->value != NULL && $checkktp->npwp != NULL){
            if($update->supplier_category == 'Service - Company'){
                $update->ci_complete_licence = '70';
            }else{
                $update->ci_complete_licence = '50';
            }

            if($update->general_information == '' || $update->general_information == NULL){
                $update->general_information = 0 + $update->ci_complete_licence;
            }else{
                // $update->general_information = $update->general_information + $update->ci_complete_licence;
                $update->general_information = 0 + $update->ci_complete_licence;
            }
        }

        if(\App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', 5)->first()){
            $update->ci_hq = '20';
            if($update->general_information == '' || $update->general_information == NULL){
                $update->general_information = 0 + $update->ci_hq;
            }else{
                $update->general_information = $update->general_information + $update->ci_hq;
            }
        }

        if($update->scoring == '' || $update->scoring == NULL){
            $update->scoring = 0 + ($update->general_information * 0.1);
        }else{
            $update->scoring = $update->scoring + ($update->general_information * 0.1);
        }
        $update->save();


        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.criteriageneralinformation'); 
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementgi::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Criteria General Information Successfully Update!!!");
        return view('livewire.vendor-management.criteriageneralinformation');  
        
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