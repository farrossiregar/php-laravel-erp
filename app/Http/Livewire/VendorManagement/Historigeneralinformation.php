<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historigeneralinformation extends Component
{    
    // protected $listeners = [
    //     'modalcriteriageneralinformation'=>'criteriageneralinformation',
    // ];
    
    public $date; 

    public $selected_id, $data, $datavm;

    // public $owner_name, $owner_licence_ktp, $owner_licence_npwp, $est_year, $hq_add, $branch_add, $telp_office, $com_name, $com_phone, $com_email, $tech_name, $tech_phone, $tech_email, $notas_gi;
    // public $main_cust, $gov_client, $other_cust, $inv_amount_3, $inv_amount_2, $inv_amount_1, $balance_asset_3, $balance_asset_2, $balance_asset_1, $balance_liab_3, $balance_liab_2, $balance_liab_1, $notas_fs;
    // public $fin_name, $fin_pos, $fin_hp, $bank_name, $bank_addr, $country, $curr, $bank_acc_owner, $bank_acc_num, $swift_code, $notas_bi;
    // public $employees_qty, $mngr_qty, $spv_qty, $engineer_qty, $tech_qty, $adm_qty, $other_qty;

    // public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    // // public $service_type1, $service_type2, $service_type3, $service_type4, $service_type5, $service_type6, $service_type7, $service_type8, $service_type9, $service_type10, $service_type11, $service_type12, $service_type13, $service_type14;
    // public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23, $value24, $value25, $value26, $value27;
    // public $value28, $value29, $value30, $value31, $value32, $value33, $value34, $value35, $value36, $value37, $value38;
    // public $value39, $value40, $value41, $value42, $value43, $value44, $value45;
    public function render()
    {
        
        return view('livewire.vendor-management.historigeneralinformation');        
    }

  
    public function save()
    {
        $user = \Auth::user();
        
        $check                                       = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->first();
        if(!$check){ 
            for($i = 1; $i < 46; $i++){
                $data                                       = new \App\Models\VendorManagementgi();
                $data->id_supplier                          = $this->selected_id;
                $data->id_detail                            = $i;
                // $data->id_detail_title                      = $this->valueconcat('service_type', $i);
                $data->value                                 = $this->valueconcat('value', $i);
                $data->save();
            }

            
        }
    
        
        
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