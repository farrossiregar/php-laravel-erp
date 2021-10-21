<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Criteriageneralinformation extends Component
{    
    // protected $listeners = [
    //     'modalcriteriageneralinformation'=>'criteriageneralinformation',
    // ];
    

    public $selected_id, $data, $datavm;

    public $owner_name, $owner_licence_ktp, $owner_licence_npwp, $est_year, $hq_add, $branch_add, $telp_office, $com_name, $com_phone, $com_email, $tech_name, $tech_phone, $tech_email, $notas_gi;
    public $main_cust, $gov_client, $other_cust, $inv_amount_3, $inv_amount_2, $inv_amount_1, $balance_asset_3, $balance_asset_2, $balance_asset_1, $balance_liab_3, $balance_liab_2, $balance_liab_1, $notas_fs;
    public $fin_name, $fin_pos, $fin_hp, $bank_name, $bank_addr, $country, $curr, $bank_acc_owner, $bank_acc_num, $swift_code, $notas_bi;
    public $employees_qty, $mngr_qty, $spv_qty, $engineer_qty, $tech_qty, $adm_qty, $other_qty;
    public function render()
    {
        return view('livewire.vendor-management.criteriageneralinformation');        
    }

    public function criteriageneralinformation($id)
    {
        $this->selected_id = $id;
       
    }

    public function mount($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $this->datavm = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->first();


        $this->owner_name = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '1')->first()->value;
        $this->owner_licence_ktp = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '2')->first()->value;
        $this->owner_licence_npwp = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '3')->first()->value;
        
        
        
        
    }
  
    public function save()
    {
        $user = \Auth::user();
       
        $check                                       = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->first();
        if($check){ 
            $dataowner                  = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '1')->first();
            $dataowner->value           = $this->owner_name;
            $dataowner->save();

            $dataownerktp                  = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '2')->first();
            $dataownerktp->value           = $this->owner_licence_ktp;
            $dataownerktp->save();

            $dataownernpwp                  = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail_group', '1')->where('id_detail', '3')->first();
            $dataownernpwp->value           = $this->owner_licence_npwp;
            $dataownernpwp->save();


            $update                         = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
            
            if($this->owner_licence_ktp && $this->owner_licence_npwp){
                if($update->supplier_category == 'Service - Company'){
                    $update->ci_complete_licence = '70';
                }else{
                    $update->ci_complete_licence = '50';
                }

                if($update->general_information == '' || $update->general_information == NULL){
                    $update->general_information = 0 + $update->ci_complete_licence;
                }else{
                    $update->general_information = $update->general_information + $update->ci_complete_licence;
                }
            }

            if($this->hq_add){
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
        }else{
            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'owner_name';
            $data->id_detail                            = '1';
            $data->value                                = $this->owner_name;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'owner_licence_ktp';
            $data->id_detail                            = '2';
            $data->value                                = $this->owner_licence_ktp;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'owner_licence_npwp';
            $data->id_detail                            = '3';
            $data->value                                = $this->owner_licence_npwp;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'est_year';
            $data->id_detail                            = '4';
            $data->value                                = $this->est_year;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'hq_add';
            $data->id_detail                            = '5';
            $data->value                                = $this->hq_add;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'branch_add';
            $data->id_detail                            = '6';
            $data->value                                = $this->branch_add;
            $data->save(); 

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'telp_office';
            $data->id_detail                            = '7';
            $data->value                                = $this->telp_office;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'com_name';
            $data->id_detail                            = '8';
            $data->value                                = $this->com_name;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'com_phone';
            $data->id_detail                            = '9';
            $data->value                                = $this->com_phone;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'com_email';
            $data->id_detail                            = '10';
            $data->value                                = $this->com_email;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'tech_name';
            $data->id_detail                            = '11';
            $data->value                                = $this->tech_name;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'tech_phone';
            $data->id_detail                            = '12';
            $data->value                                = $this->tech_phone;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'tech_email';
            $data->id_detail                            = '13';
            $data->value                                = $this->tech_email;
            $data->save();

            $data                                       = new \App\Models\VendorManagementgi();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail_group                      = '1';
            $data->id_detail_title                      = 'notas_gi';
            $data->id_detail                            = '14';
            $data->value                                = $this->notas_gi;
            $data->save();


            $update                         = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
            
            if($this->owner_licence_ktp && $this->owner_licence_npwp){
                if($update->supplier_category == 'Service - Company'){
                    $update->ci_complete_licence = '70';
                }else{
                    $update->ci_complete_licence = '50';
                }

                if($update->general_information == '' || $update->general_information == NULL){
                    $update->general_information = 0 + $update->ci_complete_licence;
                }else{
                    $update->general_information = $update->general_information + $update->ci_complete_licence;
                }
            }

            if($this->hq_add){
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
        }
        
    
        
        


        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.criteriageneralinformation'); 
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