<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayableWeeklyopex;
use App\Models\WeeklyOpexBudgetDate;
use App\Models\ClientProject;

class WeeklyOpex extends Component
{
    use WithPagination;
    public $filterproject, $filterweek, $filtermonth, $filteryear, $subrequest_type;
    protected $paginationTheme = 'bootstrap',$listeners=['refresh'=>'$refresh'];
    public $keyword,$week_id,$projects=[],$filter_client_project_id;
    public $is_apstaff=false,$is_finance=false;

    public function render()
    {
        $data = AccountPayableWeeklyopex::select('account_payable_weeklyopex.*', 'account_payable.subrequest_type')
                                        ->join('account_payable','account_payable.id','=','account_payable_weeklyopex.id_master')
                                        ->where('account_payable.request_type','2')
                                        ->where('account_payable_weeklyopex.company_id',session()->get('company_id'))
                                        ->orderBy('account_payable_weeklyopex.updated_at','DESC');

        if($this->filteryear) $data->whereYear('account_payable.created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('account_payable.created_at',$this->filtermonth);                
        if($this->subrequest_type) $data->where('account_payable.subrequest_type',$this->subrequest_type);
        if($this->filter_client_project_id) $data->where('account_payable_weeklyopex.project_name',$this->filter_client_project_id);

        $total = clone $data;

        return view('livewire.finance.weekly-opex')->with(['data'=>$data->paginate(100),'total'=>$total]);
    }

    public function mount()
    {
        $this->is_apstaff = check_access('is-apstaff');
        $this->is_finance = check_access('is-finance');
        $this->projects = ClientProject::where('is_project',1)->get();
    }
}
