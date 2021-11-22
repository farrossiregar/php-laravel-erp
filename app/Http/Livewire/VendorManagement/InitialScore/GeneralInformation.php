<?php

namespace App\Http\Livewire\VendorManagement\InitialScore;

use Livewire\Component;
use App\Models\VendorManagement;

class GeneralInformation extends Component
{
    public $data,$total_score=0,$company_complete_score=0,$personal_licence_score=0,$have_hq_office_score=0,$have_branch_office_score=0;
    public $owner_name,$owner_licence_ktp,$owner_licence_npwp;
    public $owner_licence_tdp,$owner_licence_siup,$hq_add;
    public $supplier_npwp,$branch_address,$owner_ktp,$owner_npwp,$business_tdp,$business_siup,$business_npwp,$commercial_name,$commercial_phone;
    public $commercial_email,$technical_name,$technical_phone,$technical_email,$establish_year,$hq_address,$telephone_office;
    public $initial_ta_team_qty,$employee_quantity,$high_level_manager,$engineer,$technicians,$administrative,$supervisor,$others;
    public $finance_name,$finance_position,$finance_phone;
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
        $this->data->high_level_manager = $this->data->high_level_manager;
        $this->data->supervisor = $this->data->supervisor;
        $this->data->engineer = $this->data->engineer;
        $this->data->technicians = $this->data->technicians;
        $this->data->administrative = $this->data->administrative;
        $this->data->others = $this->data->others;
        $this->data->finance_name = $this->data->finance_name;
        $this->data->finance_position = $this->data->finance_position;
        $this->data->finance_phone = $this->data->finance_phone;
        $this->data->owner_name = $this->data->owner_name;
        $this->data->owner_ktp = $this->data->owner_ktp;
        $this->data->owner_npwp = $this->data->owner_npwp;
        $this->data->business_tdp = $this->data->business_tdp;
        $this->data->business_siup = $this->data->business_siup;
        $this->data->business_npwp = $this->data->business_npwp;
        $this->data->commercial_name = $this->data->commercial_name;
        $this->data->commercial_phone = $this->data->commercial_phone;
        $this->data->commercial_email = $this->data->commercial_email;
        $this->data->technical_name = $this->data->technical_name;
        $this->data->technical_phone = $this->data->technical_phone;
        $this->data->technical_email = $this->data->technical_email;
        $this->data->establish_year = $this->data->establish_year;
        $this->data->hq_address = $this->data->hq_address;
        $this->data->branch_address = $this->data->branch_address;
        $this->data->telephone_office = $this->data->telephone_office;
        $this->data->have_branch_office_score = $this->data->initial_ci_branch;
        $this->data->have_hq_office_score = $this->data->initial_ci_hq;
        $this->data->company_complete_score = $this->data->initial_ci_complete_licence;
        $this->data->personal_licence_score = $this->data->initial_personal_licence_score;
        $this->data->total_score = $this->data->initial_general_information;
    }

    public function save()
    {
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
        $this->data->save();

        session()->flash('message-success',"Criteria General Information Successfully Evaluate!!!");
        
        return redirect()->route('vendor-management.index'); 
    }
}
