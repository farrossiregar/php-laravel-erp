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
    public $is_pmg=false, $is_apstaff=false, $is_finance_spv=false,$is_finance_manager=false,$is_finance_accounting_manager=false,$is_treasury=true;
    public function render()
    {
        $data = AccountPayable::orderBy('created_at', 'desc');
        
        if(!$this->is_apstaff and !$this->is_pmg) $data->where('employee_id',\Auth::user()->employee->id);
        if($this->filteryear) $data->whereYear('created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('created_at',$this->filtermonth);                
        if($this->filterproject) $data->where('project',\App\Models\ClientProject::where('id', $this->filterproject)->first()->name);                        
        if($this->request_type) $data->where('request_type',$this->request_type);   
        
        return view('livewire.account-payable.data')->with(['data'=>$data->paginate(50)]);   
    }

    public function mount()
    {
        $this->is_pmg = check_access('is-pmg');
        // $this->is_pmg = true;
        $this->is_finance_spv = check_access('is-finance-spv');
        // $this->is_finance_spv = true;
        $this->is_finance_manager = check_access('is-finance-manager');
        // $this->is_finance_manager = true;
        $this->is_finance_accounting_manager = check_access('is-finance-accounting-manager');
        // $this->is_finance_accounting_manager = true;
        $this->is_treasury = check_access('is-treasury');
        $this->is_apstaff = check_access('is-appstaf');
    }
}