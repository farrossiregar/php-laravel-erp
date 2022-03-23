<?php

namespace App\Http\Livewire\VendorManagement\InitialScore;

use Livewire\Component;
use App\Models\VendorManagement;
use App\Models\VendorManagementgiinit;

class GeneralInformation extends Component
{
    public $data,$total_score=0,$company_complete_score=0,$personal_licence_score=0,$have_hq_office_score=0,$have_branch_office_score=0;
    public $owner_name,$owner_licence_ktp,$owner_licence_npwp;
    public $owner_licence_tdp,$owner_licence_siup,$hq_add;
    public $supplier_npwp,$branch_address,$owner_ktp,$owner_npwp,$business_tdp,$business_siup,$business_npwp,$commercial_name,$commercial_phone;
    public $commercial_email,$technical_name,$technical_phone,$technical_email,$establish_year,$hq_address,$telephone_office;
    public $initial_ta_team_qty,$employee_quantity,$high_level_manager,$engineer,$technicians,$administrative,$supervisor,$others;
    public $finance_name,$finance_position,$finance_phone,$business_name,$notas,$supplier_name;
    public $main_customer_top_3,$government_clients_top_3,$other_customers,$var_2017_total_invoiced,$var_2018_total_invoiced,$var_2019_total_invoiced,$balance_2017;
    public $balance_2018,$balance_2019,$balance_2017_liability,$balance_2018_liability,$balance_2019_liability,$notas_financial;
    public $is_readonly_business;
    protected $listeners = ['setid'];

    public function render()
    {
        return view('livewire.vendor-management.initial-score.general-information');
    }

    public function updated($propertyName)
    {
        if($this->business_tdp and $this->business_siup and $this->business_npwp){
            $this->company_complete_score = 70;
        }
        if($this->owner_ktp and $this->owner_npwp){
            $this->personal_licence_score = 50;
        }
        if($this->hq_address){
            $this->have_hq_office_score = 20;
        }
        if($this->branch_address){
            $this->have_branch_office_score = 10;
        }
        if($this->company_complete_score and $this->personal_licence_score and $this->have_hq_office_score and $this->have_branch_office_score){
            $this->total_score = 70;
        }
    }

    public function setid(VendorManagement $data)
    {
        $this->data = $data;
        $this->employee_quantity = $this->data->employee_quantity;
        $this->high_level_manager = $this->data->high_level_manager;
        $this->supervisor = $this->data->supervisor;
        $this->engineer = $this->data->engineer;
        $this->technicians = $this->data->technicians;
        $this->administrative = $this->data->administrative;
        $this->others = $this->data->others;
        $this->finance_name = $this->data->finance_name;
        $this->finance_position = $this->data->finance_position;
        $this->finance_phone = $this->data->finance_phone;
        $this->owner_name = $this->data->owner_name;
        $this->owner_ktp = $this->data->owner_ktp;
        $this->owner_npwp = $this->data->owner_npwp;
        $this->business_tdp = $this->data->business_tdp;
        $this->business_siup = $this->data->business_siup;
        $this->business_npwp = $this->data->business_npwp;
        $this->commercial_name = $this->data->commercial_name;
        $this->commercial_phone = $this->data->commercial_phone;
        $this->commercial_email = $this->data->commercial_email;
        $this->technical_name = $this->data->technical_name;
        $this->technical_phone = $this->data->technical_phone;
        $this->technical_email = $this->data->technical_email;
        $this->establish_year = $this->data->establish_year;
        $this->hq_address = $this->data->hq_address;
        $this->branch_address = $this->data->branch_address;
        $this->telephone_office = $this->data->telephone_office;
        $this->have_branch_office_score = $this->data->initial_ci_branch ? $this->data->initial_ci_branch : 0;
        $this->have_hq_office_score = $this->data->initial_ci_hq ? $this->data->initial_ci_hq : 0;
        $this->company_complete_score = $this->data->initial_ci_complete_licence ? $this->data->initial_ci_complete_licence : 0;
        $this->personal_licence_score = $this->data->initial_personal_licence_score ? $this->data->initial_personal_licence_score : 0;
        $this->total_score = $this->data->initial_general_information ? $this->data->initial_general_information : 0;
        $this->bank_name = $this->data->bank_name;
        $this->bank_address = $this->data->bank_address;
        $this->country = $this->data->country;
        $this->currency = $this->data->currency;
        $this->bank_account_owner = $this->data->bank_account_owner;
        $this->bank_account_number = $this->data->bank_account_number;
        $this->swift_code = $this->data->swift_code;
        $this->notas_finance = $this->data->notas_finance;
        $this->business_name = $this->data->business_name;
        $this->notas = $this->data->notas;
        $this->main_customer_top_3 = $this->data->main_customer_top_3;
        $this->government_clients_top_3 = $this->data->government_clients_top_3;
        $this->other_customers = $this->data->other_customers;
        $var_2017_total_invoiced = '2017_total_invoiced';
        $var_2018_total_invoiced = '2018_total_invoiced';
        $var_2019_total_invoiced = '2019_total_invoiced';
        $this->var_2017_total_invoiced = $this->data->$var_2017_total_invoiced;
        $this->var_2018_total_invoiced = $this->data->$var_2018_total_invoiced;
        $this->var_2019_total_invoiced = $this->data->$var_2019_total_invoiced;
        $this->balance_2017 = $this->data->balance_2017;
        $this->balance_2018 = $this->data->balance_2018;
        $this->balance_2019 = $this->data->balance_2019;
        $this->balance_2017_liability = $this->data->balance_2017_liability;
        $this->balance_2018_liability = $this->data->balance_2018_liability;
        $this->balance_2019_liability = $this->data->balance_2019_liability;
        $this->notas_financial = $this->data->notas_financial;
    }

    public function save()
    {
        $field = [1=>'supplier_name',
                2=>'business_name',
                3=>'business_tdp',
                4=>'establish_year',
                5=>'hq_address',
                6=>'branch_address',
                7=>'telephone_office',
                8=>'commercial_name',
                9=>'commercial_phone',
                10=>'commercial_email',
                11=>'technical_name',
                12=>'technical_phone',
                13=>'technical_email',
                14=>'notas',
                15=>'main_customer_top_3',
                16=>'government_clients_top_3',
                17=>'other_customers',
                18=>'var_2017_total_invoiced',
                19=>'var_2018_total_invoiced',
                20=>'var_2019_total_invoiced',
                21=>'balance_2017',
                22=>'balance_2017_liability',
                23=>'balance_2018',
                24=>'balance_2018_liability',
                25=>'balance_2019',
                26=>'balance_2019_liability',
                27=>'notas_financial',
                28=>'finance_name',
                29=>'finance_position',
                30=>'finance_phone',
                31=>'bank_name',
                32=>'bank_address',
                33=>'country',
                34=>'currency',
                35=>'bank_account_owner',
                36=>'bank_account_number',
                37=>'swift_code',
                38=>'notas_finance',
                39=>'employee_quantity',
                40=>'high_level_manager',
                41=>'supervisor',
                42=>'engineer',
                43=>'technicians',
                44=>'administrative',
                45=>'others',
                46=>'business_siup',
                47=>'business_npwp'];
        foreach($field as $k => $val){
            if($val=="") continue;
            $data = new VendorManagementgiinit();
            $data->id_supplier = $this->data->id;
            $data->id_detail = $k;
            $data->value = $this->$val;
            $data->save();
        }

        $this->data->business_name = $this->business_name;
        $this->data->employee_quantity = $this->employee_quantity;
        $this->data->high_level_manager = $this->high_level_manager;
        $this->data->supervisor = $this->supervisor;
        $this->data->engineer = $this->engineer;
        $this->data->technicians = $this->technicians;
        $this->data->administrative = $this->administrative;
        $this->data->others = $this->others;
        $this->data->finance_name = $this->finance_name;
        $this->data->finance_position = $this->finance_position;
        $this->data->finance_phone = $this->finance_phone;
        $this->data->owner_name = $this->owner_name;
        $this->data->owner_ktp = $this->owner_ktp;
        $this->data->owner_npwp = $this->owner_npwp;
        $this->data->business_tdp = $this->business_tdp;
        $this->data->business_siup = $this->business_siup;
        $this->data->business_npwp = $this->business_npwp;
        $this->data->commercial_name = $this->commercial_name;
        $this->data->commercial_phone = $this->commercial_phone;
        $this->data->commercial_email = $this->commercial_email;
        $this->data->technical_name = $this->technical_name;
        $this->data->technical_phone = $this->technical_phone;
        $this->data->technical_email = $this->technical_email;
        $this->data->establish_year = $this->establish_year;
        $this->data->hq_address = $this->hq_address;
        $this->data->branch_address = $this->branch_address;
        $this->data->telephone_office = $this->telephone_office;
        $this->data->initial_ci_branch = $this->have_branch_office_score;
        $this->data->initial_ci_hq = $this->have_hq_office_score;
        $this->data->initial_ci_complete_licence = $this->company_complete_score;
        $this->data->initial_personal_licence_score = $this->personal_licence_score;
        $this->data->initial_general_information = $this->total_score;
        $this->data->bank_name = $this->bank_name;
        $this->data->bank_address = $this->bank_address;
        $this->data->country = $this->country;
        $this->data->currency = $this->currency;
        $this->data->bank_account_owner = $this->bank_account_owner;
        $this->data->bank_account_number = $this->bank_account_number;
        $this->data->swift_code = $this->swift_code;
        $this->data->notas_finance = $this->notas_finance;
        $this->data->notas = $this->notas;
        $var_2017_total_invoiced = '2017_total_invoiced';
        $var_2018_total_invoiced = '2018_total_invoiced';
        $var_2019_total_invoiced = '2019_total_invoiced';
        $this->data->$var_2017_total_invoiced = $this->var_2017_total_invoiced;
        $this->data->$var_2018_total_invoiced = $this->var_2018_total_invoiced;
        $this->data->$var_2019_total_invoiced = $this->var_2019_total_invoiced;
        $this->data->balance_2017 = $this->balance_2017;
        $this->data->balance_2018 = $this->balance_2018;
        $this->data->balance_2019 = $this->balance_2019;
        $this->data->notas_financial = $this->notas_financial;

        $this->data->initial_general_information = $this->data->initial_ci_complete_licence + $this->data->initial_ci_hq + $this->data->initial_ci_branch;
        if($this->data->supplier_category == 'Material Supplier'){
            $this->data->initial = $this->data->initial + ($this->data->initial_general_information * 0.4);
        }else{
            $this->data->initial = $this->data->initial + ($this->data->initial_general_information * 0.1);
        }
        $this->data->save();
        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return redirect()->route('vendor-management.index'); 
    }
}
 