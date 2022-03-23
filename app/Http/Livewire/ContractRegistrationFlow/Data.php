<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContractRegistrationFlow;

class Data extends Component
{
    public $date_start,$date_end,$keyword,$status,$data_id;
    public $is_business_dept_access;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = ContractRegistrationFlow::orderBy('id', 'DESC');

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('contract_registration_flow') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });

        return view('livewire.contract-registration-flow.data')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_business_dept_access = check_access('contract-registration-flow.business-dept-access');

        $data = ContractRegistrationFlow::orderBy('id', 'DESC');

        foreach($data->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
    }

    public function checkdata($id)
    {
        $check = \App\Models\ContractRegistrationFlow::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }
}



