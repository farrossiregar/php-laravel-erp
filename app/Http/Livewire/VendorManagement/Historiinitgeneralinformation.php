<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historiinitgeneralinformation extends Component
{    
    

    public $date; 
    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    // public $service_type1, $service_type2, $service_type3, $service_type4, $service_type5, $service_type6, $service_type7, $service_type8, $service_type9, $service_type10, $service_type11, $service_type12, $service_type13, $service_type14;
    public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23, $value24, $value25, $value26, $value27;
    public $value28, $value29, $value30, $value31, $value32, $value33, $value34, $value35, $value36, $value37, $value38;
    public $value39, $value40, $value41, $value42, $value43, $value44, $value45, $value46, $value47;

    public $selected_id, $data, $datavm;
    public function render()
    {
        
        return view('livewire.vendor-management.historiinitgeneralinformation');        
    }

    public function mount()
    {
        
        $this->value1 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->value;
        $this->value2 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->value;
        $this->value3 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->value;
        $this->value4 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->value;
        $this->value5 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->value;
        $this->value6 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->value;
        $this->value7 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->value;
        $this->value8 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->value;
        $this->value9 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->value;
        $this->value10 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->value;
        $this->value11 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->value;
        $this->value12 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->value;
        $this->value13 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->value;
        $this->value14 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->value;
        $this->value15 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '15')->first()->value;
        
        $this->value16 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '16')->first()->value;
        $this->value17 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '17')->first()->value;
        $this->value18 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '18')->first()->value;
        $this->value19 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '19')->first()->value;
        $this->value20 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '20')->first()->value;
        $this->value21 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '21')->first()->value;
        $this->value22 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '22')->first()->value;
        $this->value23 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '23')->first()->value;
        $this->value24 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '24')->first()->value;
        $this->value25 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '25')->first()->value;
        $this->value26 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '26')->first()->value;
        $this->value27 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '27')->first()->value;
        $this->value28 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '28')->first()->value;
        $this->value29 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '29')->first()->value;
        $this->value30 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '30')->first()->value;

        $this->value31 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '31')->first()->value;
        $this->value32 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '32')->first()->value;
        $this->value33 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '33')->first()->value;
        $this->value34 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '34')->first()->value;
        $this->value35 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '35')->first()->value;
        $this->value36 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '36')->first()->value;
        $this->value37 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '37')->first()->value;
        $this->value38 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '38')->first()->value;
        $this->value39 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '39')->first()->value;
        $this->value40 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '40')->first()->value;
        $this->value41 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '41')->first()->value;
        $this->value42 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '42')->first()->value;
        $this->value43 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '43')->first()->value;
        $this->value44 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '44')->first()->value;
        $this->value45 = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '45')->first()->value;
        $this->value46 = @\App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '46')->first()->value;
        $this->value47 = @\App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', '47')->first()->value;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        // $datavm = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id);


        // $this->service_type7 = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->id_detail_title;
    }
  
    public function save()
    {
        $suppcat = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        if($suppcat->supplier_category == 'Service - Company'){
            $rowdata = 48;
        }else{
            $rowdata = 46;
        }
        
        for($i = 1; $i < $rowdata; $i++){
            $data                                       = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            $data->value                                = $this->valueconcat('value', $i);
            $data->save();
        }
    
        $updatescoring                = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $updatescoring->scoring       = $updatescoring->scoring - $updatescoring->general_information;                      
        $updatescoring->save(); 
        
        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $checkktp                     = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 2)->first();
        $checknpwp                    = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 3)->first();
        $checkhq                      = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 5)->first();
        $checkbranch                  = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 6)->first();
        
        
        if($update->supplier_category == 'Service - Company'){
            if($this->value3 != '' && $this->value46 != '' && $this->value47 != ''){
                $update->ci_complete_licence = '70';
            }else{
                if($this->value3 == '' && $this->value46 == '' && $this->value47 == ''){
                    $update->ci_complete_licence = '0';
                }else{
                    $update->ci_complete_licence = '50';
                }
            }
        }else{
            if($this->value2 != '' && $this->value3 != ''){
                $update->ci_complete_licence = '50';
            }else{
                if($this->value2 == '' && $this->value3 == ''){
                    $update->ci_complete_licence = '0';
                }else{
                    $update->ci_complete_licence = '20';
                }
            }
        }
        
        // if($update->supplier_category == 'Service - Company'){
        //     $update->ci_complete_licence = '70';
        // }else{
        //     $update->ci_complete_licence = '50';
        // }

        // if($update->general_information == '' || $update->general_information == NULL){
        //     $update->general_information = 0 + $update->ci_complete_licence;
        // }else{
        //     // $update->general_information = $update->general_information + $update->ci_complete_licence;
        //     $update->general_information = 0 + $update->ci_complete_licence;
        // }
    

        if($checkhq->value != NULL && $checkhq->value != NULL){
            $update->ci_hq = '20';

        }

        if($checkbranch->value != NULL && $checkbranch->value != NULL){
            $update->ci_branch = '10';
        
        }

        // if($update->scoring == '' || $update->scoring == NULL){
        //     $update->scoring = 0 + ($update->general_information * 0.1);
        // }else{
        //     $update->scoring = $update->scoring + ($update->general_information * 0.1);
        // }

        $update->general_information = $update->ci_complete_licence + $update->ci_hq + $update->ci_branch;
        if($update->supplier_category == 'Material Supplier'){
            $update->scoring = $update->scoring + ($update->general_information * 0.4);
        }else{
            $update->scoring = $update->scoring + ($update->general_information * 0.1);
        }
        
        $update->save();


        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.criteriageneralinformation'); 
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementgiinit::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
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