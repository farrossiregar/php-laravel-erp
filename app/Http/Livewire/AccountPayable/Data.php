<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use Auth;
use App\Models\AccountPayable;

class Data extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name, $request_type;
    protected $paginationTheme = 'bootstrap';
    public $is_pmg=true, $is_apstaff=true, $is_finance_spv=true,$is_finance_manager=true,$is_finance_accounting_manager=true,$is_treasury=true;
    public function render()
    {
        if($this->is_finance_spv){
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '1')
                                ->orWhere('request_type', '=', '2')
                                ->orWhere('request_type', '=', '3');
                        })->orderBy('created_at', 'desc');
        }elseif($this->is_finance_manager){
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '4')
                                ->orWhere('request_type', '=', '5')
                                ->orWhere('request_type', '=', '6');
                        })->orderBy('created_at', 'desc');
        }elseif($this->is_finance_accounting_manager){
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '7')
                                ->orWhere('request_type', '=', '8')
                                ->orWhere('request_type', '=', '9');
                        })->orderBy('created_at', 'desc');
        }elseif(check_access('is-pmg') || $this->is_treasury){
            $data = AccountPayable::orderBy('created_at', 'desc');
        }else{
            $user = Auth::user();
            // $data = \App\Models\AccountPayable::where('nik', $user->nik)->orderBy('created_at', 'desc');
            $data = \App\Models\AccountPayable::orderBy('created_at', 'desc');
        }
        if($this->filteryear) $data->whereYear('created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('created_at',$this->filtermonth);                
        if($this->filterproject) $data->where('project',\App\Models\ClientProject::where('id', $this->filterproject)->first()->name);                        
        if($this->request_type) $data->where('request_type',$this->request_type);                        
        
        return view('livewire.account-payable.data')->with(['data'=>$data->paginate(50)]);   
    }

    public function mount()
    {
        // $this->is_pmg = check_access('is-pmg');
        $this->is_pmg = true;
        // $this->is_finance_spv = check_access('is-finance-spv');
        $this->is_finance_spv = true;
        // $this->is_finance_manager = check_access('is-finance-manager');
        $this->is_finance_manager = true;
        // $this->is_finance_accounting_manager = check_access('is-finance-accounting-manager');
        $this->is_finance_accounting_manager = true;
        $this->is_treasury = check_access('is-treasury');
    }
}