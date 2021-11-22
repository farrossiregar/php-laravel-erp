<?php

namespace App\Http\Livewire\VendorManagement\InitialScore;

use Livewire\Component;

class GeneralInformation extends Component
{
    public $total_score=0,$complete_licence_score=0,$have_hq_office=0,$have_branch_office=0;
    public $owner_name,$owner_licence_ktp,$owner_licence_npwp;
    public $owner_licence_tdp,$owner_licence_siup;
    public function render()
    {
        return view('livewire.vendor-management.initial-score.general-information');
    }
}
