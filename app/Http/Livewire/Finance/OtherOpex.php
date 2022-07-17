<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\AccountPayableOtheropex;

class OtherOpex extends Component
{
    public function render()
    {
        $data = AccountPayableOtheropex::where('company_id',session()->get('company_id'))
                    ->orderBy('updated_at','DESC');

            // if($this->filteryear) $data->whereYear('account_payable.created_at',$this->filteryear);
            // if($this->filtermonth) $data->whereMonth('account_payable.created_at',$this->filtermonth);                
            // if($this->subrequest_type) $data->where('account_payable.subrequest_type',$this->subrequest_type);

        return view('livewire.finance.other-opex')->with(['data'=>$data->paginate(100)]);
    }
}
