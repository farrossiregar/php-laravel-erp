<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use App\Models\VendorManagement;
class Initialgeneralinformation extends Component
{    
    public $selected_id, $data, $datavm;
    public $owner_name, $owner_licence_ktp, $owner_licence_npwp, $est_year, $hq_add, $branch_add, $telp_office, $com_name, $com_phone, $com_email, $tech_name, $tech_phone, $tech_email, $notas_gi;
    public $main_cust, $gov_client, $other_cust, $inv_amount_3, $inv_amount_2, $inv_amount_1, $balance_asset_3, $balance_asset_2, $balance_asset_1, $balance_liab_3, $balance_liab_2, $balance_liab_1, $notas_fs;
    public $fin_name, $fin_pos, $fin_hp, $bank_name, $bank_addr, $country, $curr, $bank_acc_owner, $bank_acc_num, $swift_code, $notas_bi;
    public $employees_qty, $mngr_qty, $spv_qty, $engineer_qty, $tech_qty, $adm_qty, $other_qty;
    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23, $value24, $value25, $value26, $value27;
    public $value28, $value29, $value30, $value31, $value32, $value33, $value34, $value35, $value36, $value37, $value38;
    public $value39, $value40, $value41, $value42, $value43, $value44, $value45, $value46, $value47;
    public $total_score=0,$complete_licence_score=0,$have_hq_office=0,$have_branch_office=0;
    protected $listeners = ['set_id' => 'initialgeneralinformation'];
    public function render()
    {
        return view('livewire.vendor-management.initialgeneralinformation');        
    }

    public function initialgeneralinformation(VendorManagement $id)
    {
        $this->selected_id = $id;
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
            $data                                       = new \App\Models\VendorManagementgiinit();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            $data->value                                = $this->valueconcat('value', $i);
            $data->save();
        }

        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $checkktp                     = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 2)->first();
        $checknpwp                    = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 3)->first();
        $checkhq                      = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 5)->first();
        $checkbranch                  = \App\Models\VendorManagementgiinit::where('id_supplier', $this->selected_id)->where('id_detail', 6)->first();

        
        if($update->supplier_category == 'Service - Company'){
            if($this->value3 != '' && $this->value46 != '' && $this->value47 != ''){
                $update->initial_ci_complete_licence = '70';
            }else{
                if($this->value3 == '' && $this->value46 == '' && $this->value47 == ''){
                    $update->initial_ci_complete_licence = '0';
                }else{
                    $update->initial_ci_complete_licence = '50';
                }
            }
        }else{
            if($this->value2 != '' && $this->value3 != ''){
                $update->initial_ci_complete_licence = '50';
            }else{
                if($this->value2 == '' && $this->value3 == ''){
                    $update->initial_ci_complete_licence = '0';
                }else{
                    $update->initial_ci_complete_licence = '20';
                }
            }
        }

        if($checkhq->value != NULL && $checkhq->value != NULL){
            $update->initial_ci_hq = '20';

        }

        if($checkbranch->value != NULL && $checkbranch->value != NULL){
            $update->initial_ci_branch = '10';
        }


        $update->initial_general_information = $update->initial_ci_complete_licence + $update->initial_ci_hq + $update->initial_ci_branch;
        if($update->supplier_category == 'Material Supplier'){
            $update->initial = $update->initial + ($update->initial_general_information * 0.4);
        }else{
            $update->initial = $update->initial + ($update->initial_general_information * 0.1);
        }
        
        $update->save();

        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.initialgeneralinformation'); 
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementgiinit::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Criteria General Information Successfully Update!!!");
        return view('livewire.vendor-management.initialgeneralinformation');  
        
    }

    public function valueconcat($field, $i){
        $fields = $field.$i;
        return $this->$fields;
    }
}